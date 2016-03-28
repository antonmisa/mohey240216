<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 22.01.2016
 * Time: 14:12
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MainGenusController
{
    /**
     * @Route
     * @Route("/genus")
     */
    public function showAction()
    {
        return new Response('Under the sea!');
    }
}