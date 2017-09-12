<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 11:40 PM
 */

namespace Tests\Domain\Factory;

use Carbon\Carbon;
use Domain\Entity\Customer;
use Domain\Factory\CustomerFactory;
use Domain\ValueObject\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CustomerFactoryTest extends TestCase
{
    /**
     * @param $array
     * @param $expected
     * @param $message
     * @dataProvider arrayProvider
     */
    public function testCreateFromArray($array, $expected, $message)
    {
        $customer = CustomerFactory::createFromArray($array);
        $this->assertEquals($expected, $customer, $message);
        $this->assertInstanceOf(Customer::class, $customer);
    }

    /**
     * @param $array
     * @dataProvider arrayExceptionProvider
     */
    public function testCreateFromArrayException($array)
    {
        $this->expectException(InvalidArgumentException::class);
        $customer = CustomerFactory::createFromArray($array);
    }

    /**
     * @param $collection
     * @param $expected
     * @param $message
     * @dataProvider collectionProvider
     */
    public function testCreateFromCollection($collection, $expected, $message)
    {
        $customers = CustomerFactory::createFromCollection($collection);
        $this->assertEquals($expected, $customers, $message);
        $this->assertInstanceOf(Customer::class, $customers[0]);
    }

    /**
     * @param $collection
     * @dataProvider collectionExceptionProvider
     */
    public function testCreateFromCollectionException($collection)
    {
        $this->expectException(InvalidArgumentException::class);
        $customers = CustomerFactory::createFromCollection($collection);
    }

    public function arrayProvider()
    {
        $data1 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'asd@qwe.com',
            'last_access' => '2017-08-01 13:00:00'
        ];

        $customer1 = new Customer();
        $customer1->setId(123);
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        $data2 = [
            'id' => 456,
            'name' => 'Davis',
            'active' => false,
            'email' => 'qwe@asd.com',
            'last_access' => '2017-08-02 11:00:00'
        ];

        $customer2 = new Customer();
        $customer2->setId(456);
        $customer2->setName('Davis');
        $customer2->setActive(false);
        $customer2->setEmail(new Email('qwe@asd.com'));
        $customer2->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-02 11:00:00'));

        return [
            [$data1, $customer1, 'regular test'],
            [$data2, $customer2, 'regular test']
        ];
    }

    public function arrayExceptionProvider()
    {
        $data1 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'xxxxx',
            'last_access' => '2017-08-01 13:00:00'
        ];

        $data2 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'asd@qwe.com',
            'last_access' => '01/08/2017'
        ];

        return [
            [$data1],
            [$data2]
        ];
    }

    public function collectionProvider()
    {
        $data1 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'asd@qwe.com',
            'last_access' => '2017-08-01 13:00:00'
        ];

        $customer1 = new Customer();
        $customer1->setId(123);
        $customer1->setName('Renato');
        $customer1->setActive(true);
        $customer1->setEmail(new Email('asd@qwe.com'));
        $customer1->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-01 13:00:00'));

        $data2 = [
            'id' => 456,
            'name' => 'Davis',
            'active' => false,
            'email' => 'qwe@asd.com',
            'last_access' => '2017-08-02 11:00:00'
        ];

        $customer2 = new Customer();
        $customer2->setId(456);
        $customer2->setName('Davis');
        $customer2->setActive(false);
        $customer2->setEmail(new Email('qwe@asd.com'));
        $customer2->setLastAccess(Carbon::createFromFormat('Y-m-d H:i:s', '2017-08-02 11:00:00'));

        return [
            [[$data1, $data2], [$customer1, $customer2], 'regular test']
        ];
    }

    public function collectionExceptionProvider()
    {
        $data1 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'xxxxx',
            'last_access' => '2017-08-01 13:00:00'
        ];

        $data2 = [
            'id' => 123,
            'name' => 'Renato',
            'active' => true,
            'email' => 'asd@qwe.com',
            'last_access' => '01/08/2017'
        ];

        return [
            [[$data1, $data2]]
        ];
    }
}
