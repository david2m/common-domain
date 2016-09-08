<?php
namespace David2M\CommonDomain\AggregateRoot;

use David2M\CommonDomain\Entity\BaseEntity;

abstract class BaseAggregateRoot extends BaseEntity implements AggregateRoot
{

    /* @var array */
    private $_recordedEvents = [];

    public function recordEvent($event)
    {
        $this->_recordedEvents[] = $event;
    }

    public function releaseEvents() : array
    {
        $events = $this->_recordedEvents;
        $this->_recordedEvents = [];

        return $events;
    }

}