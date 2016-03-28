<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Common;

/**
 * Description of LoggerHelp
 *
 * @author anton
 */
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class LoggerHelp {
    
    private $logger;

    public function __construct(LoggerInterface $logger) 
    {
        $this->logger = $logger;
    }
    
    public function writeInfoLog($message) 
    {
        $this->logger->info($message);
    }
    
    //put your code here
    //protected static $_instance;
    /*
     * @var \Symfony\Component\DependencyInjection\ContainerInterface 
     */
    //private $container;
 
    //private function __construct(Container $container)
    //{
    //    $this->container = $container;
    //}
 
    //private function __clone(){
    //}
    
    //static public function getInstance(Container $container) {
    #static public function getInstance() {
        // проверяем актуальность экземпляра
    //    if (null === self::$_instance) {
    //        // создаем новый экземпляр
    //        self::$_instance = new self($container);
    //    }
        // возвращаем созданный или существующий экземпляр
    //    return self::$_instance;
    //}
    
    //public function isDev()
    //{
    //    $kernel = $this->container->get('kernel');
    //    return $kernel->isDebug();
    //}
    
    //public function writeInfoLog($message, $onlyDebug = true)
    //{
    //    if (($onlyDebug && $this->isDev()) || (!$onlyDebug))
    //    {
    //        $logger = $this->container->get('logger');
    //        $logger->info($message);
    //    }
    //}
}
