<?php
namespace David2M\CommonDomain\Event;

class Dispatcher
{

    /* @var callable[] */
    private $listeners = [];

    public function addListener(string $pattern, callable $listener)
    {
        if (!isset($this->listeners[$pattern])) {
            $this->listeners[$pattern] = [];
        }

        $this->listeners[$pattern][] = $listener;
    }

    /**
     * @param object $event
     */
    public function dispatch($event)
    {
        if (!is_object($event)) {
            throw new \InvalidArgumentException('Cannot dispatch an event which is not an object.');
        }

        $eventName = get_class($event);
        foreach ($this->getListeners($eventName) as $listener) {
            $listener($event);
        }
    }

    /**
     * @param object[] $events
     */
    public function dispatchAll(array $events)
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }

    /**
     * @param string $eventName
     *
     * @return \Generator|callable[]
     */
    private function getListeners($eventName)
    {
        foreach ($this->listeners as $pattern => $listeners) {
            if (preg_match('#' . $pattern . '#', $eventName)) {
                foreach ($listeners as $listener) {
                    yield $listener;
                }
            }
        }
    }

}