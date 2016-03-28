<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 13:52
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MoheyUserRepository")
 * @ORM\Table(name="moheyuser")
 * @ORM\HasLifecycleCallbacks()
 */
class MoheyUser implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=100)
     */    
    private $realname;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    private $facebookID;

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private $googleID;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $social;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gender;
    
    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $locale;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_on;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_login;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_on;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MoheyOffer", mappedBy="user")
     */
    protected $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->isActive = true;
    }
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        //using Doctrine DateTime here
        $this->created_on = new \DateTime('now');
        $this->updated_on = new \DateTime('now');
    }
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        //using Doctrine DateTime here
        $this->updated_on = new \DateTime('now');
    }
    /**
     * Get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userName
     *
     * @param string $username
     *
     * @return User
     */
    public function setUserName($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }
    
    /**
     * Set realName
     *
     * @param string $realname
     *
     * @return User
     */
    public function setRealName($realname)
    {
        $this->realname = $realname;
        return $this;
    }

    /**
     * Get realName
     *
     * @return string
     */
    public function getRealName()
    {
        return $this->realname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * Set created_on
     *
     * @param \DateTime $createdOn
     * @return User
     */
    public function setCreatedOn($createdOn)
    {
        $this->created_on = $createdOn;
        return $this;
    }

    /**
     * Get created_on
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * Set last_login
     *
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;
        return $this;
    }

    /**
     * Get last_login
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Set updated_on
     *
     * @param \DateTime $updatedOn
     * @return User
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updated_on = $updatedOn;
        return $this;
    }

    /**
     * Get updated_on
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updated_on;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    
    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return User
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return MoheyUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set social
     *
     * @param string $social
     * @return User
     */
    public function setSocial($social)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Get social
     *
     * @return string
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     *
     * @return User
     */
    public function setfacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string
     */
    public function getfacebookID()
    {
        return $this->facebookID;
    }

    /**
     * Set googleID
     *
     * @param string $googleID
     *
     * @return User
     */
    public function setgoogleID($googleID)
    {
        $this->googleID = $googleID;
        return $this;
    }

    /**
     * Get googleID
     *
     * @return string
     */
    public function getgoogleID()
    {
        return $this->googleID;
    }

    /**
     * Add offer
     *
     * @param \AppBundle\Entity\MoheyOffer $offer
     *
     * @return MoheyUser
     */
    public function addOffer(\AppBundle\Entity\MoheyOffer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\MoheyOffer $offer
     */
    public function removeOffer(\AppBundle\Entity\MoheyOffer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }
}
