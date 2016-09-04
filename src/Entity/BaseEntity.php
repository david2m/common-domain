<?php
namespace David2M\CommonDomain\Entity;

use David2M\CommonDomain\ValueObject\ValueObject;

abstract class BaseEntity implements Entity
{

    /* @var ValueObject */
    protected $id;

    public function __construct(ValueObject $id)
    {
        $this->id = $id;
    }

    public function getId() : ValueObject
    {
        return $this->id;
    }

    public function equals(Entity $other) : bool
    {
        return $this->id->equals($other->getId());
    }

}