<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function add(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getRecette($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT recette.nom, recette.duree, niveau_difficulte.description niveau, categories_prix.description prix
                FROM recette, niveau_difficulte, categories_prix
                WHERE recette.difficulte = niveau_difficulte.niveau
                AND recette.prix = categories_prix.categorie
                AND recette.id = :id
            ';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery(['id' => $id]);

        return $result->fetchAllAssociative();
    }
}
