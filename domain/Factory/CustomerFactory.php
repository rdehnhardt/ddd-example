<?php

namespace Domain\Factory;

use Carbon\Carbon;
use Domain\Entity\Customer;
use Domain\ValueObject\Email;
use InvalidArgumentException;

/**
 * Class CustomerFactory
 * @package Domain\Factory
 */
class CustomerFactory
{
    /**
     * @param array $params
     * @return Customer
     * @throws InvalidArgumentException
     */
    public static function createFromArray(array $params)
    {
        $customer = new Customer();
        $customer->setId($params['id']);
        $customer->setName($params['name']);
        $customer->setActive($params['active']);
        $customer->setEmail(new Email($params['email']));
        $customer->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', $params['last_access']));

        return $customer;
    }

    /**
     * @param array $records
     * @throws InvalidArgumentException
     * @return Customer[]
     */
    public static function createFromCollection(array $records)
    {
        $output = [];

        array_map(function ($item) use (&$output) {
            $output[] = self::createFromArray($item);
        }, $records);

        return $output;
    }
}
