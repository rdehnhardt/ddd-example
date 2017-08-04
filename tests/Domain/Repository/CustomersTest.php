<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 11:41 PM
 */

namespace Tests\Domain\Repository;

use App\Db;
use Carbon\Carbon;
use Domain\Entity\Customer;
use Domain\Repository\Customers;
use Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase
{
    protected $db;

    public function setUp()
    {
        $this->db = $this->createMock(Db::class);
    }

    /**
     * @param $customer
     * @param $expected
     * @param $message
     * @dataProvider createProvider
     */
    public function testCreate($customer, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('insert')
            ->willReturn($expected);

        $this->db
            ->expects($this->once())
            ->method('id')
            ->willReturn(123);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->create($customer), $message);
    }

    /**
     * @param $customer
     * @param $expected
     * @param $message
     * @dataProvider updateProvider
     */
    public function testUpdate($customer, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('update')
            ->willReturn($expected);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->update($customer), $message);
    }

    /**
     * @param $date
     * @param $expected
     * @param $message
     * @dataProvider lastAccessProvider
     */
    public function testGetFromLastAccess($date, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('query');

        $repo = new Customers($this->db);
        $repo->getFromLastAccess($date);
    }

    /**
     * @param $expected
     * @param $message
     * @dataProvider activatedProvider
     */
    public function testGetActivated($expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('query')
            ->willReturn(PDOStatement::class);

        $repo = new Customers($this->db);
        $customers = $repo->getActivated();

        $this->assertEquals($expected, $customers, $message);

        foreach ($customers as $customer) {
            $this->assertEquals(true, $customer->isActive());
        }
    }

    public function createProvider()
    {
        $customer1 = new Customer();
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        return [
            [$customer1, true, 'called']
        ];
    }

    public function updateProvider()
    {
        $customer1 = new Customer();
        $customer1->setId(123);
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        return [
            [$customer1, true, 'called']
        ];
    }

    public function lastAccessProvider()
    {
        $customer1 = new Customer();
        $customer1->setId(123);
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        $customer2 = new Customer();
        $customer2->setId(456);
        $customer2->setName('Davis');
        $customer2->setActive(false);
        $customer2->setEmail(new Email('qwe@asd.com'));
        $customer2->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-02 11:00:00'));

        return [
            [Carbon::now(), [$customer1, $customer2], 'called']
        ];
    }

    public function activatedProvider()
    {
        $customer1 = new Customer();
        $customer1->setId(123);
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        $customer2 = new Customer();
        $customer2->setId(456);
        $customer2->setName('Davis');
        $customer2->setActive(true);
        $customer2->setEmail(new Email('qwe@asd.com'));
        $customer2->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-02 11:00:00'));

        return [
            [[$customer1, $customer2], 'check']
        ];
    }
}
