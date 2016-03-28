<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 11:24
 */

namespace AppBundle\Entity;


class LandingForm
{
    protected $price;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}