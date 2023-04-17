<?php

namespace App\Repository;

use App\Entity\Sandwich;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sandwich>
 *
 * @method Sandwich|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sandwich|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sandwich[]    findAll()
 * @method Sandwich[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SandwichRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sandwich::class);
    }

    public function save(Sandwich $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sandwich $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById($idSandwich): ?Sandwich
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id = :idSandwich')
            ->setParameter('idSandwich', $idSandwich)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
