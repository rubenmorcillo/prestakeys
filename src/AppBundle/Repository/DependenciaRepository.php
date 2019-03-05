<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Dependencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DependenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dependencia::class);
    }

    public function findTodas()
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.nombre')
            ->getQuery()
            ->getResult();
    }
}
