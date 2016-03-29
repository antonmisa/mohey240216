<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 29.01.2016
 * Time: 13:19
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserPanelController extends Controller
{
    /**
     * @Route("/userpanel", name="userpanel")
     */
    public function showUserPanelAction(Request $request)
    {
        return $this->render('mohey/userpanel.html.twig');
    }
}