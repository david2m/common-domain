<?php
namespace Tests\David2M\CommonDomain\Event;

use PHPUnit\Framework\TestCase;
use David2M\CommonDomain\Event\Dispatcher;

require('fixtures.php');

class DispatcherTest extends TestCase
{

    /* @var Dispatcher */
    private $dispatcher;

    public function setUp()
    {
        parent::setUp();
        $this->dispatcher = new Dispatcher();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Cannot dispatch an event which is not an object.
     */
    public function test_dispatch_eventIsNotAnObject_throwInvalidArgumentException()
    {
        $event = [];
        $this->dispatcher->dispatch($event);
    }

    public function test_dispatch_listenerExistsForEventBeingDispatched_callListener()
    {
        $event = new \UserSignedUp();
        $mockListener = $this->getMockBuilder(\SendEmailOnUserSignup::class)->getMock();
        $mockListener
            ->expects($this->once())
            ->method('onSignup')
            ->with($event);
        $this->dispatcher->addListener('UserSignedUp', [$mockListener, 'onSignup']);

        $this->dispatcher->dispatch($event);
    }

    public function test_dispatch_listenerDoesNotExistForEventBeingDispatched_doNotCallListener()
    {
        $event = new \UserSignedUp();
        $mockListener = $this->getMockBuilder(\SendEmailOnUserSignup::class)->getMock();
        $mockListener
            ->expects($this->never())
            ->method('onSignup');
        $this->dispatcher->addListener('Some\Fake\Event', [$mockListener, 'onSignup']);

        $this->dispatcher->dispatch($event);
    }

    public function test_dispatch_twoListenersExistForEventBeingDispatched_callListeners()
    {
        $event = new \UserSignedUp();
        $mockListenerOne = $this->getMockBuilder(\SendEmailOnUserSignup::class)->getMock();
        $mockListenerOne
            ->expects($this->once())
            ->method('onSignup')
            ->with($event);
        $mockListenerTwo = $this->getMockBuilder(\AddUserToMailingListOnSignup::class)->getMock();
        $mockListenerTwo
            ->expects($this->once())
            ->method('onSignup')
            ->with($event);
        $this->dispatcher->addListener('UserSignedUp', [$mockListenerOne, 'onSignup']);
        $this->dispatcher->addListener('UserSignedUp', [$mockListenerTwo, 'onSignup']);

        $this->dispatcher->dispatch($event);
    }

    public function test_dispatchAll_twoListenersExistForTwoEvents_callListeners()
    {
        $eventOne = new \UserSignedUp();
        $mockListenerOne = $this->getMockBuilder(\SendEmailOnUserSignup::class)->getMock();
        $mockListenerOne
            ->expects($this->once())
            ->method('onSignup')
            ->with($eventOne);
        $eventTwo = new \OrderShipped();
        $mockListenerTwo = $this->getMockBuilder(\SendEmailOnOrderShipped::class)->getMock();
        $mockListenerTwo
            ->expects($this->once())
            ->method('onOrderShipped')
            ->with($eventTwo);

        $this->dispatcher->addListener('UserSignedUp', [$mockListenerOne, 'onSignup']);
        $this->dispatcher->addListener('OrderShipped', [$mockListenerTwo, 'onOrderShipped']);

        $this->dispatcher->dispatchAll([$eventOne, $eventTwo]);
    }

    public function test_dispatchAll_listenerExistsWhichListensForAllEvents_callListenerTwice()
    {
        $eventOne = new \UserSignedUp();
        $eventTwo = new \OrderShipped();

        $mockListener = $this->getMockBuilder(\AddToMessageQueueOnEvent::class)->getMock();
        $mockListener
            ->expects($this->at(0))
            ->method('onEvent')
            ->with($eventOne);
        $mockListener
            ->expects($this->at(1))
            ->method('onEvent')
            ->with($eventTwo);

        $this->dispatcher->addListener('.+', [$mockListener, 'onEvent']);

        $this->dispatcher->dispatchAll([$eventOne, $eventTwo]);
    }

}