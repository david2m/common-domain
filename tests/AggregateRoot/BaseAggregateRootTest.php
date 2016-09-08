<?php
namespace Tests\David2M\CommonDomain\AggregateRoot;

use David2M\CommonDomain\ValueObject\ValueObject;
use PHPUnit\Framework\TestCase;

require('fixtures.php');

class BaseAggregateRootTest extends TestCase
{

    /* @var \Competition */
    private $competition;

    public function setUp()
    {
        parent::setUp();

        $stubId = $this->getMockForAbstractClass(ValueObject::class);
        $this->competition = new \Competition($stubId);
    }

    public function test_releaseEvents_noEventsRecorded_returnEmptyArray()
    {
        $recordedEvents = $this->competition->releaseEvents();
        self::assertEmpty($recordedEvents);
    }

    public function test_releaseEvents_oneEventRecorded_returnArrayWithRecordedEvent()
    {
        $event = new \StoppedTakingRegistrations();
        $this->competition->recordEvent($event);

        $recordedEvents = $this->competition->releaseEvents();

        self::assertSame([$event], $recordedEvents);
    }

    public function test_releaseEvents_multipleEventsRecorded_returnArrayWithRecordedEvents()
    {
        $eventOne = new \StoppedTakingRegistrations();
        $eventTwo = new \RegistrationPriceChanged();

        $this->competition->recordEvent($eventOne);
        $this->competition->recordEvent($eventTwo);

        $recordedEvents = $this->competition->releaseEvents();

        self::assertSame([$eventOne, $eventTwo], $recordedEvents);
    }

    public function test_releaseEvents_deleteRecordedEventsFromEntity()
    {
        $event = new \StoppedTakingRegistrations();
        $this->competition->recordEvent($event);

        $this->competition->releaseEvents();
        $recordedEvents = $this->competition->releaseEvents();

        self::assertEmpty($recordedEvents);
    }

}