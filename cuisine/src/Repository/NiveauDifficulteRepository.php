<?php

namespace App\Repository;

use App\Entity\NiveauDifficulte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NiveauDifficulte>
 *
 * @method NiveauDifficulte|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauDifficulte|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauDifficulte[]    findAll()
 * @method NiveauDifficulte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauDifficulteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauDifficulte::class);
    }

    public function add(NiveauDifficulte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NiveauDifficulte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NiveauDifficulte[] Returns an array of NiveauDifficulte objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NiveauDifficulte
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
