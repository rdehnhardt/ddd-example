<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 11:41 PM
 */

namespace Tests\Domain\Repository;

use App\Db;
use Domain\Repository\Customers;
use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase
{
    protected $db;

    public function setUp()
    {
        $this->db = $this->createMock(Db::class);
    }

    public function testCreate($customer, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('insert')
            ->willReturn($expected);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->create($customer), $message);
    }

    public function testUpdate($customer, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('update')
            ->willReturn($expected);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->update($customer), $message);
    }

    public function testGetFromLastAccess($date, $expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('query')
            ->willReturn($expected);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->getFromLastAccess($date), $message);
    }

    public function testGetActivated($expected, $message)
    {
        $this->db
            ->expects($this->once())
            ->method('query')
            ->willReturn($expected);

        $repo = new Customers($this->db);
        $this->assertEquals($expected, $repo->getActivated(), $message);
    }
}
