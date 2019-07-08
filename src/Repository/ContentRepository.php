<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\ShowSearch;
use App\Entity\RelatedContentSearch;

class ContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Content::class);
    }

    /**
     * returns a query of all shows with potential filters on show admin list
     * @param ShowSearch $search parameters for filtering shows
     * @return \Doctrine\ORM\Query a query that will be managed by Paginator
     */
    public function findAllShowsQuery(ShowSearch $search)
    {
        $type = 'festival';
        if (null !== $search->getContentType()) {
            $type = $search->getContentType();
        }
        $query =  $this->createQueryBuilder('c')
            ->andWhere('c.contentType = :val')
            ->setParameter('val', $type)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(10);
            
        if ($search->getIsComplete()) {
            $query = $query->andWhere('c.complete != :complete');
            $query->setParameter('complete', $search->getIsComplete());
        }
        if ($search->getIsTranslated()) {
            $query = $query->andWhere('c.translated != :translated');
            $query->setParameter('translated', $search->getIsTranslated());
        }

            return $query->getQuery() ;
    }

    public function findAllContentQuery(RelatedContentSearch $search)
    {
            $query =  $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(10);
        if ($search->getContentType()) {
            $query = $query->andWhere('c.contentType = :type');
            $query->setParameter('type', $search->getContentType());
        }
            return $query->getQuery() ;
    }
}
