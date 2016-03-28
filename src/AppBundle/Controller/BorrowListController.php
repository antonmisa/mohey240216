<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 12:41
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Form\MoheyPostType;
use AppBundle\Entity\LandingForm;
use AppBundle\Form\BorrowListPostType;
use AppBundle\Entity\BorrowListSearchForm;
use AppBundle\Entity\MoheyOfferRepository;
use AppBundle\Common\ConstantHelp;

class BorrowListController extends Controller
{
    /**
     * @Route("/requestborrowlist", name="requestborrowlist")
     */
    public function requestBorrowListAction(Request $request)
    {   
        $page = $request->get("draw");
        if (($page == null) || ($page == 0) || (!is_numeric($page))) {
            $page = 1;
        }
        $page = $request->get("draw");        
        $order = $request->get("order");
        $columns = $request->get("columns");             
        
        $price = $request->get("price");
        if (($price = null) || (!is_int($price))) {
            $price = ConstantHelp::DefPrice();
        }                
        
        $totalItems = ConstantHelp::TotalBorrowCount();
        $blf = new BorrowListSearchForm();        
        $blf->setPrice($price);
        $blf->setPage($page);
        $repository = $this->getDoctrine()->getRepository('AppBundle:MoheyOffer');
        $offers = $repository->findAllOffers($blf, $totalItems, $columns, $order, true);                                
        
        return new JsonResponse(array(
            'draw' => $page,
            'recordsTotal' => sizeof($offers),
            'recordsFiltered' => $totalItems,
            'data' => $offers
        ));
    }
    /**
     * @Route("/borrowlist", name="borrowlist")
     */
    public function showBorrowListAction(Request $request)
    {     
        $blf = new BorrowListSearchForm();
        
        $lf = new LandingForm();
        $borrow_form = $this->createForm(MoheyPostType::class, $lf);
        $borrow_form->handleRequest($request);
        if ($borrow_form->isSubmitted() && $borrow_form->isValid())
        {
            $blf->setPrice($lf->getPrice());
        }
        
        return $this->render('mohey/borrowlist.html.twig', array('borrowlist' => $blf));
        
//        $page = 1;
//        //$pageSize = 10;
//        $maxPages = 10;
//
//        $lf = new LandingForm();
//        $borrow_form   = $this->createForm(MoheyPostType::class, $lf);
//
//        $borrow_form->handleRequest($request);
//
//        if ($borrow_form->isSubmitted() && $borrow_form->isValid())
//        {
//            //first show after landing page
//            $price = $lf->getPrice();
//
//            //filter enabled offers near $price
//            $blf = new BorrowListForm();
//            $blf->setPriceTo($price);
//            $blf->setPriceFrom($price);
//            $blf->setPage(1);
//            $blist_form   = $this->createForm(BorrowListPostType::class, $blf, array(
//                'action' => $this->generateUrl('borrowlist'),
//                'method' => 'POST',));
//
//            $repository = $this->getDoctrine()->getRepository('AppBundle:MoheyOffer');
//            $offers = $repository->findAllOffers($blf);            
//        }
//        else
//        {
//            //next page maybe
//            $blf = new BorrowListForm();
//            $blist_form   = $this->createForm(BorrowListPostType::class, $blf, array(
//                'action' => $this->generateUrl('borrow'),
//                'method' => 'POST',));
//
//            $blist_form->handleRequest($request);
//
//            if ($blist_form->isSubmitted() && $blist_form->isValid())
//            {
//                $page = $blist_form->getPage();
//            }
//            else
//            {
//                $blf = new BorrowListForm();
//                $blf->setPriceTo(ConstantHelp::MaxPrice());
//                $blf->setPriceFrom(0);
//                $blf->setPage(1);
//                $blist_form   = $this->createForm(BorrowListPostType::class, $blf, array(
//                    'action' => $this->generateUrl('borrowlist'),
//                    'method' => 'POST',));
//
//                $repository = $this->getDoctrine()->getRepository('AppBundle:MoheyOffer');
//                $offers = $repository->findAllOffers($blf);                
//            }
//        }       
        //return $this->render('mohey/borrowlist.html.twig', array('offers' => $offers, 'maxPages' => $maxPages, 'thisPage' => $page, 'borrowlist_form' => $blist_form->createView(), 'borrowlist' => $blf));
    }
}