<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\MoheyPostType;
use AppBundle\Entity\LandingForm;
use AppBundle\Common\LoggerHelp;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   
        #$request->getSession()->clear();        
        
        //$loan_name = $this->get('translator')->trans('loan');
        //$borrow_name = $this->get('translator')->trans('borrow');

        $lf = new LandingForm();
        $loan_form = $this->createForm(MoheyPostType::class, $lf, array(
            'action' => $this->generateUrl('newloan'),
            'method' => 'POST',));
        $borrow_form = $this->createForm(MoheyPostType::class, $lf, array(
            'action' => $this->generateUrl('borrowlist'),
            'method' => 'POST',));

        return $this->render('mohey/index.html.twig', array(//'loan_name' => $loan_name, 'borrow_name' => $borrow_name,
            'loan_form' => $loan_form->createView(), 'borrowlist_form' => $borrow_form->createView()));
    }

    /*
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    */
}
