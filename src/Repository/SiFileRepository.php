<?php

namespace App\Repository;

use App\Entity\SiFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiFile[]    findAll()
 * @method SiFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiFile::class);
    }

    // /**
    //  * @return SiFile[] Returns an array of SiFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiFile
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
