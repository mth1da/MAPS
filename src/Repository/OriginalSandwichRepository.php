<?php

namespace App\Repository;

use App\Entity\OriginalSandwich;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OriginalSandwich>
 *
 * @method OriginalSandwich|null find($id, $lockMode = null, $lockVersion = null)
 * @method OriginalSandwich|null findOneBy(array $criteria, array $orderBy = null)
 * @method OriginalSandwich[]    findAll()
 * @method OriginalSandwich[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OriginalSandwichRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OriginalSandwich::class);
    }

    public function save(OriginalSandwich $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OriginalSandwich $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}