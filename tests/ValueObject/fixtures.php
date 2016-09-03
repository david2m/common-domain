<?php
use David2M\CommonDomain\ValueObject\BaseValueObject;

class EmailAddress extends BaseValueObject
{

    /* @var string */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

}