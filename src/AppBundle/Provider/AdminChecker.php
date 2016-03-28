<?php
namespace AppBundle\Provider;

use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Class AdminChecker
 * @package AppBundle\Provider
 */
class AdminChecker{

    /**
     * @var Doctrine
     */
    protected $doctrine;

    /**
     * @var array
     */
    protected $admins;

    public function __construct(Doctrine $doctrine, array $admins)
    {
        $this->doctrine = $doctrine;
        $this->admins = $admins;
    }

    /***
     * @param User $user
     * @return bool
     */
    public function check(User $user)
    {
        $isIt = false;

        $isIt = $isIt || (isset($this->admins['facebook']) && in_array($user->getfacebookID(), $this->admins['facebook']));
        $isIt = $isIt || (isset($this->admins['google']) && in_array($user->getgoogleID(), $this->admins['google']));

        return $isIt;
    }
}