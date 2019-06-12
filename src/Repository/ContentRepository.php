<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\ShowSearch;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Content::class);
    }
    /**
     * returns a query of all shows with potential filters
     * @param ShowSearch $search parameters for filtering show
     * @return \Doctrine\ORM\Query
     */
    public function findAllShowsQuery(ShowSearch $search)
    {
        $query =  $this->createQueryBuilder('c')
            ->andWhere('c.contentType = :val')
            ->setParameter('val', Content::CONTENT_TYPE['show'])
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
}
