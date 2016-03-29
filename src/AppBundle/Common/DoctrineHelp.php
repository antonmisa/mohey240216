<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 27.01.2016
 * Time: 16:42
 */

namespace AppBundle\Common;

use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrineHelp
{
    static public function paginate($query, &$totalItems, &$pageSize = 10, &$currentPage = 1){
        $pageSize = (int)$pageSize;
        $currentPage = (int)$currentPage;

        if( $pageSize < 1 ){
            $pageSize = 10;
        }

        if( $currentPage < 1 ){
            $currentPage = 1;
        }

        $paginator = new Paginator($query);

        $totalItems = 10;//count($paginator);
        
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage - 1))
            ->setMaxResults($pageSize)
        ;

        return $paginator;
    }
}