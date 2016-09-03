<?php
namespace David2M\CommonDomain\ValueObject;

abstract class BaseValueObject implements ValueObject
{

    public function equals(ValueObject $other) : bool
    {
        return ($this == $other);
    }

}