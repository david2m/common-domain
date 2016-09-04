<?php
namespace David2M\CommonDomain\Entity;

use David2M\CommonDomain\ValueObject\ValueObject;

interface Entity
{

    public function getId() : ValueObject;

    public function equals(Entity $other) : bool;

}