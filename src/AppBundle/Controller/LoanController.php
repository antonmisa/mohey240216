<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 12:33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MoheyOffer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\LoanPostType;

class LoanController extends Controller
{
    /**
     * @Route("/loan/{id}", name="loan", defaults={"id" = 1})
     */
    public function showLoanAction(Request $request, $id)
    {
        $lf = new LandingForm();
        $loan_form   = $this->createForm(LoanPostType::class, $lf, array(
            'action' => $this->generateUrl('loan'),
            'method' => 'POST',));

        $loan_form->handleRequest($request);

        if ($loan_form->isSubmitted() && $loan_form->isValid())
        {
            $price = $lf->getPrice();
        }

        return new Response('The loan: ' + $price);
    }

    /**
     * @Route("/mohey/newloan", name="newloan")
     */
    public function showNewLoanAction(Request $request)
    {
        $user = $this->getUser();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $this->redirectToRoute('login');
            throw $this->createAccessDeniedException();
        }
        else
        {
            $offer = new MoheyOffer();
            $newloan_form = $this->createForm(LoanPostType::class, $offer, array(
                'action' => $this->generateUrl('newloan'),
                'method' => 'POST',));

            $newloan_form->handleRequest($request);

            if ($newloan_form->isSubmitted() && $newloan_form->isValid()) {
                //add loan to db!
                $em = $this->getDoctrine()->getManager();
                $em->persist($offer);
                $em->flush();
                return new Response('The loan was added!');
            } else {
                return $this->render('mohey/loan.html.twig', array('loan_form' => $newloan_form->createView()));
            }
        }
    }

}