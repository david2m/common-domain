<?php
namespace Tests\David2M\CommonDomain\Entity;

use David2M\CommonDomain\ValueObject\ValueObject;
use PHPUnit\Framework\TestCase;

require('fixtures.php');

class BaseEntityTest extends TestCase
{

    public function test_createEntity_shouldSetId()
    {
        $stubId = $this->getMockForAbstractClass(ValueObject::class);

        $customer = new \Customer($stubId);

        self::assertTrue($stubId === $customer->getId());
    }

    public function test_equals_entitiesNotEqual_returnFalse()
    {
        $stubIdOne = $this->getMockForAbstractClass(ValueObject::class);
        $stubIdOne
            ->method('equals')
            ->willReturn(false);
        $stubIdTwo = $this->getMockForAbstractClass(ValueObject::class);

        $customerOne = new \Customer($stubIdOne);
        $customerTwo = new \Customer($stubIdTwo);

        self::assertFalse($customerOne->equals($customerTwo));
    }

    public function test_equals_entitiesAreEqual_returnTrue()
    {
        $stubIdOne = $this->getMockForAbstractClass(ValueObject::class);
        $stubIdOne
            ->method('equals')
            ->willReturn(true);
        $stubIdTwo = $this->getMockForAbstractClass(ValueObject::class);

        $customerOne = new \Customer($stubIdOne);
        $customerTwo = new \Customer($stubIdTwo);

        self::assertTrue($customerOne->equals($customerTwo));
    }

}