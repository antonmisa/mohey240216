<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 28.01.2016
 * Time: 16:14
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\BorrowListSearchForm;
use AppBundle\Common\DoctrineHelp;
use AppBundle\Common\ConstantHelp;

class MoheyOfferRepository extends EntityRepository
{
    public function findAllOffers(\AppBundle\Entity\BorrowListSearchForm $blf, $columns = null, $order = null, $serialize = false)
    {
        $totalItems = 0;
        $pageSize = ConstantHelp::BorrowListLength();
        $price = $blf->getPrice();
        $proc = $blf->getProc();
        $page = $blf->getPage();
        $date = $blf->getDate();
        

        $qb = $this->createQueryBuilder('p')
            ->select('p, p.offer_id, p.price_from, p.price_to, p.proc_from, p.proc_to, p.date_from, p.date_to, u.username')
            ->innerJoin('p.user', 'u')
            ->where('(true = :allowprice AND NOT (p.price_from >= :price OR p.price_to <= :price) OR false = :allowprice) '
                    . 'AND (true = :allowproc AND NOT (p.proc_from >= :proc OR p.proc_to <= :proc) OR false = :allowproc) '
                    . 'AND (true = :allowdate AND NOT (p.date_from >= :date OR p.date_to <= :date) OR false = :allowdate) '
                    . 'AND p.kind = 1 AND p.isActive = 1')
            ->setParameter('price', $price)
            ->setParameter('proc', $proc)
            ->setParameter('date', $date);
        
        if ($price > 0)
        {
            $qb->setParameter('allowprice', true);
        }
        else
        {
            $qb->setParameter('allowprice', false);            
        }
        
        if ($proc > 0)
        {
            $qb->setParameter('allowproc', true);
        }
        else
        {
            $qb->setParameter('allowproc', false);            
        }    
        
        if ($date > 0)
        {
            $qb->setParameter('allowdate', true);
        }
        else
        {
            $qb->setParameter('allowdate', false);            
        }          
            
        if ($order != null && $columns != null && sizeOf($order) > 0)
        {
            //like [ 0 => [ column => 1, dir => asc ] ]
            $col_id   = $order[0]["column"];
            $col_dir  = $order[0]["dir"];
            $col_name = $columns[$col_id]["data"];
            $col_ord  = $columns[$col_id]["orderable"];
            if ($col_ord == 'true') {
                if ($col_name == 'username') {
                    $qb->orderBy("u." . $col_name, $col_dir);
                }
                else {
                    $qb->orderBy("p." . $col_name, $col_dir);
                }
            }
        }
        else
        {
            //$qb->orderBy("p.price_to" , "desc");
        }
        $query = $qb->getQuery();

        $values = DoctrineHelp::paginate($query, $totalItems, $pageSize, $page);
        $blf->setTotalCount($totalItems);        
        if ($serialize) {
            $return_values = array();
            foreach($values as $value) {
                array_push($return_values, array("DT_RowId" => (string)$value['offer_id'], 
                                                 "username" => $value['username'], 
                                                 "price_from" => $value['price_from'], 
                                                 "price_to" => $value['price_to'], 
                                                 "proc_from" => $value['proc_from'], 
                                                 "proc_to" => $value['proc_to'], 
                                                 "date_from"=> $value['date_from'],
                                                 "date_to" => $value['date_to']));
            }
            return $return_values;
        }
        else {
            return $values;
        }
    }
}