<?php
namespace AppBundle\Provider;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider AS BaseOAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use AppBundle\Entity\User;
use AppBundle\Provider\OAuthUser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Provider\AdminChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use AppBundle\Common\LoggerHelp;
/***
 * Class Provider
 * @package AppBundle\Provider
 *
 *
 */
class OAuthUserProvider extends BaseOAuthUserProvider
{
    /***
     * @var Session
     */
    protected $session;

    /**LoggerHelp
     * @var Request
     */
    protected $request;

    /**
     * @var Doctrine
     */
    protected $doctrine;
    
    /**
     * @var 
     */
    protected $logger;

    /***
     * @param Session $session
     * @param Doctrine $doctrine
     * @param AdminChecker $adminChecker
     * @param RequestStack $requestStack
     */
    public function __construct(Session $session, Doctrine $doctrine, AdminChecker $adminChecker, RequestStack $requestStack, LoggerHelp $loggerHelp) {
        $this->session = $session;
        $this->doctrine = $doctrine;
        $this->adminChecker = $adminChecker;
        $this->request   = $requestStack->getCurrentRequest();
        $this->logger = $loggerHelp;
    }

    private function getUserById($id) {
        return $this->doctrine
            ->getRepository('AppBundle\Entity\User')
            ->findOneById($id);
    }

    /***
     * @param string $id
     * @return OAuthUser|\HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByUsername($id)
    {
        $this->logger->writeInfoLog('loadUserByUsername');
        
        $user = $this->getUserById($id);
        #if ($user == null)
        #{
        #    return null;
        #}
        #else
        #{
            return new OAuthUser($id, $user, $this->adminChecker->check($user));
        #}
    }

    /***
     * @param UserResponseInterface $response
     * @return OAuthUser|\HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        #$logger = LoggerHelp::getInstance(null); 
        #$logger->writeInfoLog('loadUserByOAuthUserResponse');
        
        $uri = $this->request->getUri();

        $this->logger->writeInfoLog('loadUserByOAuthUserResponse: '.$uri);
        
        $isFacebook = false;
        $isGoogle = false;

        if(strpos($uri, '/check-google') !== false)
            $isGoogle = true;
        if(strpos($uri, '/check-facebook') !== false)
            $isFacebook = true;

        if($isGoogle === false && $isFacebook === false)
            throw new \Exception("Invalid social network login attempt");

        $social = "";
        if($isGoogle)
            $social = "google";
        if($isFacebook)
            $social = "facebook";

        //check to see if the user is logged in and if she is logged in with the same social network
        $isLoggedInAlready = $this->session->has('user');
        $isLoggedInAlreadyId = $this->session->get('user')['id'];
        if($isLoggedInAlready && $this->session->get('user')['social'] == $social)
            return $this->loadUserByUsername($isLoggedInAlreadyId);

        $social_id = $response->getUsername();
        $nickname = $response->getNickname();
        $realName = $response->getRealName();
        $email = $response->getEmail();
        
        $arrResponse = $response->getResponse();
        $locale = $arrResponse['locale'];
        $gender = $arrResponse['gender'];
        #$avatar = $response->getProfilePicture();
        
        #$arrayString = implode(",", $arr);
        #$this->logger->writeInfoLog('response: '.$arrayString);
        $this->logger->writeInfoLog('nickname: '.$nickname.' realName: '.$realName);
        
        //set data in session. upon logging out we just erase the whole array.
        $sessionData = array();
        $sessionData['social_id'] = $social_id;
        $sessionData['username'] = $social_id;
        $sessionData['nickname'] = $nickname;
        $sessionData['realName'] = $realName;
        $sessionData['email'] = $email;
        #$sessionData['avatar'] = $avatar;
        $sessionData['social'] = $social;
        $sessionData['locale'] = $locale;
        $sessionData['gender'] = $gender;

        $user = null;
        if($isLoggedInAlready)
            $user = $this->doctrine
                ->getRepository('AppBundle\Entity\User')
                ->findOneById($isLoggedInAlreadyId);
        else if($isFacebook)
            $user = $this->doctrine
                ->getRepository('AppBundle\Entity\User')
                ->findOneByFacebookID($social_id);
                #->findOneByFid($social_id);
        else if($isGoogle)
            $user = $this->doctrine
                ->getRepository('AppBundle\Entity\User')
                ->findOneByGoogleId($social_id);

        if ($user == null) {
            $user = new User();

            //change these only the user hasn't been registered before.
            $user->setUserName($nickname);
            $user->setRealname($realName);
            $user->setLocale($locale);
            $user->setGender($gender);
            #$user->setAvatar($avatar);
        }


        if($isFacebook)
            $user->setfacebookID($social_id);
        else if($isGoogle)
            $user->setgoogleID($social_id);


        $user->setLastLogin(new \DateTime('now'));
        $user->setSocial($social);

        // SET E-MAIL
        //if all emails are empty, set the first one to this one.
        if ($user->getEmail() == "") {
            $user->setEmail($email);
        }
        #else {
        #    //if it really is an e-mail, try putting it in email2 or email3
        #    if($email != "") {
        #        //is the e-mail different than the previous one?
        #        if($email != $user->getEmail()) {
        #            //if there an e-mail in email2? no:
        #            if ($user->getEmail2() == "") {
        #                $user->setEmail2($email);
        #            } else {
        #                //there is an e-mail in email2 and it's different. fall back to setting the user3 to w/e.
        #                if ($user->getEmail2() != $email) {
        #                    $user->setEmail3($email);
        #                }
        #            }
        #        }
        #    }
        #}

        //save all changes
        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();

        $id = $user->getId();

        //set id
        $sessionData['id'] = $id;
        $sessionData['is_admin'] = $this->adminChecker->check($user);

        $this->session->set('user', $sessionData);
        return $this->loadUserByUsername($user->getId());
    }

    /***
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'AppBundle\\Provider\\OAuthUser';
    }
}