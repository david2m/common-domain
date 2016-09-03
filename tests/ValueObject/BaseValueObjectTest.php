<?php
namespace Tests\David2M\CommonDomain\ValueObject;

use PHPUnit\Framework\TestCase;

require('fixtures.php');

class BaseValueObjectTest extends TestCase
{

    public function test_equals_valueObjectsNotEqual_returnFalse()
    {
        $emailAddressOne = new \EmailAddress('john@hotmail.com');
        $emailAddressTwo = new \EmailAddress('bob@gmail.com');

        self::assertFalse($emailAddressOne->equals($emailAddressTwo));
    }

    public function test_equals_valueObjectsAreEqual_returnTrue()
    {
        $value = 'john@hotmail.com';
        $emailAddressOne = new \EmailAddress($value);
        $emailAddressTwo = new \EmailAddress($value);

        self::assertTrue($emailAddressOne->equals($emailAddressTwo));
    }

}