<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 28.01.2016
 * Time: 11:51
 */

namespace AppBundle\Entity;

use AppBundle\Common\ConstantHelp;

class BorrowListSearchForm
{
    protected $page;
    public $price;
    protected $proc;
    protected $date;

    public function __construct()
    {
        $this->page = 1;
        $this->price_from = 0;
        $this->price_to = ConstantHelp::MaxPrice();
        $this->proc_from = 0;
        $this->proc_to = ConstantHelp::MaxProc();
        $this->date_from = 0;
        $this->date_to = ConstantHelp::MaxDate();        
    }
    
    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getProc()
    {
        return $this->proc;
    }

    public function setProc($proc)
    {
        $this->proc = $proc;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}