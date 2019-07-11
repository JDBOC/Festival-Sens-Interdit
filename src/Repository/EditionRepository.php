<?php

namespace App\Repository;

use App\Entity\Edition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Edition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Edition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Edition[]    findAll()
 * @method Edition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Edition::class);
    }

    /**
     * Return Edition by Status = 'archive'
     */
    public function editionByStatus($status)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.status = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult();
    }


     /**
      * change all online edition to archive
      */
    
    public function setActiveEditionsToArchive()
    {
        $this->createQueryBuilder('e')
            ->update(Edition::class, 'e')
            ->set('e.status', ':archive')
            ->setParameter('enLigne', 'en ligne')
            ->where('e.status = :enLigne')
            ->setParameter('archive', 'archive')
            ->getQuery()
            ->execute()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Edition
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
