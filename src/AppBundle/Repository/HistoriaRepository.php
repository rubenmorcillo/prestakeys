<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Historia;
use AppBundle\Entity\Llave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class HistoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historia::class);
    }

    public function findUltimosPorLlave(Llave $llave)
    {
        return $this->createQueryBuilder('h')
            ->select('h')
            ->addSelect('u')
            ->join('h.usuario', 'u')
            ->where('h.llave = :llave')
            ->setParameter('llave', $llave)
            ->orderBy('h.fechaPrestamo', 'DESC')
            ->getQuery()
            ->setMaxResults(10)
            ->getResult();
    }
}
