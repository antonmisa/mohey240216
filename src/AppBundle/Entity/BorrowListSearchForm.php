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
    public $minpage;
    public $maxpage;
    public $totalcount;
    public $page;
    protected $price;
    protected $proc;
    protected $date;

    public function __construct()
    {        
        $this->price = -1;
        $this->proc = -1;
        $this->date = -1;  
        $this->totalcount = ConstantHelp::TotalBorrowCount();  
        $this->setPage(1);        
    }
    
    private function setMinMaxPage()
    {
        if ($this->page > 3)
        {
            $this->minpage = $this->page - 2;
        }
        else
        {
            $this->minpage = 1;
        }        
        
        if ($this->page + 2 < $this->totalcount)
        {
            $this->maxpage = $this->page + 2;
        }
        else
        {
            $this->maxpage = $this->totalcount;
        }         
    }
    
    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;   
        $this->setMinMaxPage();
    }
    
    public function getTotalCount()
    {
        return $this->totalcount;
    }

    public function setTotalCount($totalcount)
    {
        $this->totalcount = $totalcount;
        $this->setMinMaxPage();
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