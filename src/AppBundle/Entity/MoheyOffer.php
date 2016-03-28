<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 13:57
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MoheyOfferRepository")
 * @ORM\Table(name="moheyoffer")
 */
class MoheyOffer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $offer_id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MoheyUser", inversedBy="offers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    //0-loan, 1-borrow
    /**
     * @ORM\Column(type="integer")
     */
    protected $kind;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price_from;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price_to;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $proc_from;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $proc_to;
    /**
     * @ORM\Column(type="integer")
     */
    protected $date_from;
    /**
     * @ORM\Column(type="integer")
     */
    protected $date_to;

    public function __construct()
    {
        $this->isActive = true;
    }
    /**
     * Get offerId
     *
     * @return integer
     */
    public function getOfferId()
    {
        return $this->offer_id;
    }

    public function setOfferId($offerId)
    {
        return $this;
    }

    ///**
    // * Set userId
    // *
    // * @param integer $userId
    // *
    // * @return MoheyOffer
    // */
    //public function setUserId($userId)
    //{
    //    $this->user_id = $userId;
    //    return $this;
    //}

    ///**
    // * Get userId
    // *
    // * @return integer
    // */
    //public function getUserId()
    //{
    //    return $this->user_id;
    //}

    /**
     * Set kind
     *
     * @param integer $kind
     *
     * @return MoheyOffer
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get kind
     *
     * @return integer
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set priceFrom
     *
     * @param string $priceFrom
     *
     * @return MoheyOffer
     */
    public function setPriceFrom($priceFrom)
    {
        $this->price_from = $priceFrom;

        return $this;
    }

    /**
     * Get priceFrom
     *
     * @return string
     */
    public function getPriceFrom()
    {
        return $this->price_from;
    }

    /**
     * Set priceTo
     *
     * @param string $priceTo
     *
     * @return MoheyOffer
     */
    public function setPriceTo($priceTo)
    {
        $this->price_to = $priceTo;

        return $this;
    }

    /**
     * Get priceTo
     *
     * @return string
     */
    public function getPriceTo()
    {
        return $this->price_to;
    }

    /**
     * Set procFrom
     *
     * @param string $procFrom
     *
     * @return MoheyOffer
     */
    public function setProcFrom($procFrom)
    {
        $this->proc_from = $procFrom;

        return $this;
    }

    /**
     * Get procFrom
     *
     * @return string
     */
    public function getProcFrom()
    {
        return $this->proc_from;
    }

    /**
     * Set procTo
     *
     * @param string $procTo
     *
     * @return MoheyOffer
     */
    public function setProcTo($procTo)
    {
        $this->proc_to = $procTo;

        return $this;
    }

    /**
     * Get procTo
     *
     * @return string
     */
    public function getProcTo()
    {
        return $this->proc_to;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return MoheyOffer
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
     * Set user
     *
     * @param \AppBundle\Entity\MoheyUser $user
     *
     * @return MoheyOffer
     */
    public function setUser(\AppBundle\Entity\MoheyUser $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\MoheyUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set dateFrom
     *
     * @param integer $dateFrom
     *
     * @return MoheyOffer
     */
    public function setDateFrom($dateFrom)
    {
        $this->date_from = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return integer
     */
    public function getDateFrom()
    {
        return $this->date_from;
    }

    /**
     * Set dateTo
     *
     * @param integer $dateTo
     *
     * @return MoheyOffer
     */
    public function setDateTo($dateTo)
    {
        $this->date_to = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return integer
     */
    public function getDateTo()
    {
        return $this->date_to;
    }
}
