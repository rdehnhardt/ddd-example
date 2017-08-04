<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 11:40 PM
 */

namespace Tests\Domain\Factory;

use Domain\Entity\Customer;
use Domain\Factory\CustomerFactory;
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
     * @param $expected
     * @param $message
     * @dataProvider arrayExceptionProvider
     */
    public function testCreateFromArrayException($array, $expected, $message)
    {
        $this->expectException(InvalidArgumentException::class);
        $customer = CustomerFactory::createFromArray($array);
        $this->assertEquals($expected, $customer, $message);
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
     * @param $expected
     * @param $message
     * @dataProvider collectionExceptionProvider
     */
    public function testCreateFromCollectionException($collection, $expected, $message)
    {
        $this->expectException(InvalidArgumentException::class);
        $customers = CustomerFactory::createFromCollection($collection);
        $this->assertEquals($expected, $customers[0], $message);
    }

    public function arrayProvider()
    {
        return [
            [],
            []
        ];
    }

    public function arrayExceptionProvider()
    {
        return [
            [],
            []
        ];
    }

    public function collectionProvider()
    {
        return [
            [],
            []
        ];
    }

    public function collectionExceptionProvider()
    {
        return [
            [],
            []
        ];
    }
}
