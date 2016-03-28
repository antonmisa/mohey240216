<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\MoheyPostType;
use AppBundle\Entity\LandingForm;

class MoheyController extends Controller
{
    public function showAction(Request $request)
    {
//        $loan_name = $this->get('translator')->trans('loan');
//        $borrow_name = $this->get('translator')->trans('borrow');
//
//        $lf = new LandingForm();
//        $lf->setPrice(50);
//        $loan_form   = $this->createForm(MoheyPostType::class, $lf, array(
//            'action' => $this->generateUrl('newloan'),
//            'method' => 'POST',));
//        $borrow_form = $this->createForm(MoheyPostType::class, $lf, array(
//            'action' => $this->generateUrl('borrowlist'),
//            'method' => 'POST',));
//
//        return $this->render('mohey/index.html.twig', array('loan_name' => $loan_name, 'borrow_name' => $borrow_name,
//            'loan_form' => $loan_form->createView(), 'borrowlist_form' => $borrow_form->createView()));
    }

}
