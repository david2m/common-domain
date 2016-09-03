<?php
namespace David2M\CommonDomain\ValueObject;

interface ValueObject
{

    public function equals(ValueObject $other) : bool;

}