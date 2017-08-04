<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 11:41 PM
 */

namespace Tests\Domain\Service;

use App\Db;
use Carbon\Carbon;
use Domain\Entity\Customer;
use Domain\Repository\Customers;
use Domain\Service\Customer\Invalidate;
use Exception;
use PHPUnit\Framework\TestCase;

class InvalidateTest extends TestCase
{
    /**
     * @param $repo
     * @dataProvider invalidateProvider
     */
    public function testInvalidateService($repo)
    {
        $service = new Invalidate($repo);
        $service->fire();
    }

    /**
     * @param $repo
     * @dataProvider invalidateExceptionProvider
     */
    public function testInvalidateServiceException($repo)
    {
        $service = new Invalidate($repo);
        $this->assertEquals(false, $service->fire());
    }

    public function invalidateProvider()
    {
        $db = $this->createMock(Db::class);

        $repo = $this->getMockBuilder(Customers::class)
            ->setMethods(['getFromLastAccess', 'update'])
            ->setConstructorArgs([$db])
            ->getMock();

        $customer1 = $this->createMock(Customer::class);
        $customer1
            ->expects($this->once())
            ->method('setActive')
            ->with(false)
        ;

        $customer2 = $this->createMock(Customer::class);
        $customer2
            ->expects($this->once())
            ->method('setActive')
            ->with(false)
        ;

        $repo->expects($this->once())
            ->method('getFromLastAccess')
            ->willReturn([$customer1, $customer2]);

        $repo->expects($this->exactly(2))
            ->method('update');

        return [
            [$repo]
        ];
    }

    public function invalidateExceptionProvider()
    {
        $repo = $this->createMock(Customers::class);
        $repo
            ->method('getFromLastAccess')
            ->with(Carbon::now()->subYears(1))
            ->willThrowException(new Exception());

        return [
            [$repo]
        ];
    }
}
