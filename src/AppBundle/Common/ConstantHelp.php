<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Common;

class ConstantHelp
{
    static public function MaxPrice() {
        return 9999999999;
    }
    
    static public function MaxProc() {
        return 9999;
    }
    
    static public function MaxDate() {
        return 9999;
    }    
    
    static public function TotalBorrowCount() {
        return 9999999999;
    }
    
    static public function BorrowListLength() {
        return 10;
    }    
    
    static public function DefPriceFrom() {
        return 50;
    }
    
    static public function DefPriceTo() {
        return 50;
    }   
    
    static public function DefPrice() {
        return 50;
    }    
    
    static public function DefDeltaPrice() {
        return 25;
    }     
}