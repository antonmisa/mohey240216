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

use AppBundle\Form\BorrowPostType;

class BorrowController extends Controller
{
    /**
     * @Route("/borrow/{id}", name="borrow", defaults={"id" = 1})
     */
    public function showBorrowAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:MoheyOffer');
        $offer = $repository->find($id);

        $b_form = $this->createForm(BorrowPostType::class, $offer, array(
            'action' => $this->generateUrl('borrow', array('id' => $id)),
            'method' => 'POST',));

        $b_form->handleRequest($request);

        if ($b_form->isSubmitted() && $b_form->isValid())
        {
            return new Response('Here is the integration with payment!');
        }
        else
        {
            return $this->render('mohey/borrow.html.twig', array('borrow_form' => $b_form->createView()));
        }
    }
}