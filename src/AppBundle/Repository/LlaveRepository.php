<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Llave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class LlaveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Llave::class);
    }

    public function findPrestadas()
    {
        return $this->createQueryBuilder('l')
            ->addSelect('d')
            ->addSelect('u')
            ->join('l.dependencia', 'd')
            ->join('l.usuario', 'u')
            ->orderBy('l.fechaPrestamo')
            ->getQuery()
            ->getResult();
    }

    public function findNoPrestadas()
    {
        return $this->createQueryBuilder('l')
            ->addSelect('d')
            ->join('l.dependencia', 'd')
            ->where('l.usuario IS NULL')
            ->orderBy('l.codigo')
            ->getQuery()
            ->getResult();
    }

    public function findTodas()
    {
        return $this->createQueryBuilder('l')
            ->addSelect('d')
            ->addSelect('u')
            ->join('l.dependencia', 'd')
            ->leftJoin('l.usuario', 'u')
            ->orderBy('l.fechaPrestamo')
            ->getQuery()
            ->getResult();
    }
}
