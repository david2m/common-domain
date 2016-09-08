<?php
namespace David2M\CommonDomain\AggregateRoot;

use David2M\CommonDomain\Entity\Entity;

interface AggregateRoot extends Entity
{

    /**
     * @param object $event
     */
    public function recordEvent($event);

    /**
     * @return object[]
     */
    public function releaseEvents() : array;

}