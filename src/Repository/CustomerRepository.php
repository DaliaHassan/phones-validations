<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CustomerRepository extends EntityRepository
{
    /**
     * Get Customers Phones
     *
     * @return QueryBuilder
     */
    public function getCustomersPhones()
    {
        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder->select('c.phone');

        return $queryBuilder->getQuery();
    }
}