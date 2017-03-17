<?php

namespace Domain\Repository;

use Carbon\Carbon;
use Domain\Entity\Customer;
use Domain\Factory\CustomerFactory;
use App\Db;

class Customers
{
    /**
     * @var Db
     */
    private $db;

    /**
     * Customers constructor.
     * @param Db $db
     */
    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    /**
     * @param Customer $customer
     * @return bool
     */
    public function create(Customer $customer)
    {
        $created = $this->db->insert('customers', [
            'name' => $customer->getName(),
            'email' => (string) $customer->getEmail(),
            'active' => $customer->isActive(),
            'last_access' => $customer->getLastAccess()->format(Carbon::W3C),
        ]);

        if ($created) {
            $customer->setId($this->db->id());
        }

        return $created;
    }

    /**
     * @param Customer $customer
     * @return bool|int
     */
    public function update(Customer $customer)
    {
        return $this->db->update('customers', [
            'name' => $customer->getName(),
            'email' => (string) $customer->getEmail(),
            'active' => $customer->isActive(),
            'last_access' => $customer->getLastAccess()->format(Carbon::W3C),
        ],['id' => $customer->getId()]);
    }

    /**
     * @param Carbon $date
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getFromLastAccess(Carbon $date)
    {
        $data = $this->db->query("SELECT * FROM customers WHERE last_access <= '" . $date->format('Y-m-d') . "'")->fetchAll();

        return CustomerFactory::createFromCollection($data);
    }

    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getActivated()
    {
        $data = $this->db->query('SELECT * FROM customers WHERE active = true')->fetchAll();

        return CustomerFactory::createFromCollection($data);
    }
}

