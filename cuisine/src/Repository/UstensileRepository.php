<?php

namespace App\Repository;

use App\Entity\Ustensile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ustensile>
 *
 * @method Ustensile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ustensile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ustensile[]    findAll()
 * @method Ustensile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UstensileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ustensile::class);
    }

    public function add(Ustensile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ustensile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getUstensiles($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT ustensile.nom, ustensile_recette.quantite
            FROM ustensile, ustensile_recette  
            WHERE ustensile.id = ustensile_recette.ustensile_id  
            AND recette_id = :id
        ';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery(['id' => $id]);

        return $result->fetchAllAssociative();
    }
}
