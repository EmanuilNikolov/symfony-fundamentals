<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;

/**
 * CarRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your
 * own custom repository methods below.
 */
class CarRepository extends EntityRepository
{
    public function getAllCarsByMake(string $make)
    {
        return $this->createQueryBuilder('c')
          ->where('c.make = :make')
          ->setParameter('make', $make)
          ->addOrderBy('c.model', 'ASC')
          ->addOrderBy('c.travelledDistance', 'DESC')
          ->getQuery()
          ->getResult();
    }
}