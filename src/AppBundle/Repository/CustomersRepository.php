<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Customers;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * CustomersRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your
 * own custom repository methods below.
 */
class CustomersRepository extends EntityRepository
{

    public const VALID_ORDER_BY = [
      "ASCENDING" => "ASC",
      "DESCENDING" => "DESC",
    ];

    public function getAllCustomersByGivenOrder(string $order)
    {
        $order = strtoupper($order);

        $orderSanitized = array_key_exists($order, self::VALID_ORDER_BY)
          ? self::VALID_ORDER_BY[$order]
          : null;

        return $this->createQueryBuilder('customers')
          ->orderBy('customers.birthDate', $orderSanitized)
          ->getQuery()
          ->getResult();
    }

    public function getCustomerTotalSales(int $id)
    {
        return $this->createQueryBuilder('customers')
          ->where('customers.id = :id')
          ->setParameter('id', $id)
          ->leftJoin('customers.sales', 's')
          ->getQuery()->getOneOrNullResult();
    }
}
