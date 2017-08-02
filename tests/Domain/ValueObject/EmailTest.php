<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 8/2/17
 * Time: 7:43 AM
 */

namespace Tests\Domain\ValueObject;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Domain\ValueObject\Email;

class EmailTest extends TestCase
{
    /**
     * @param $string
     * @param $expected
     * @param $message
     * @dataProvider successProvider
     */
    public function testIsSuccessCreation($string, $expected, $message)
    {
        $objEmail = new Email($string);
        $this->assertInstanceOf($expected, $objEmail, $message);
        $this->assertEquals($string, $objEmail->__toString());
    }

    /**
     * @param $string
     * @dataProvider exceptionProvider
     */
    public function testIsExceptionCreation($string)
    {
        $this->expectException(InvalidArgumentException::class);
        $objEmail = new Email($string);
    }

    public function successProvider()
    {
        return [
            ['john.doe@example.com', Email::class, 'Simple positive test'],
            ['  jane.doe@example.com  ', Email::class, 'Simple positive test']
        ];
    }

    public function exceptionProvider()
    {
        return [
            ['a string']
        ];
    }
}

