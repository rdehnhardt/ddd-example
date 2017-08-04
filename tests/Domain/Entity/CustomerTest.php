<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 7:14 AM
 */

namespace Tests\Domain\Entity;

use Domain\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testBasic()
    {
        $customer = new Customer();
        $customer->setId(1);
        $this->assertEquals(1, $customer->getId());
    }
}
