<?php

namespace PE\Component\EventManager;

/**
 * @TODO update after PSR-14 accepted
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var ListenersCollection[]
     */
    private $events = [];

    /**
     * @inheritdoc
     */
    public function attach($event, $callback, $priority = 0)
    {
        if (!array_key_exists($event, $this->events)) {
            $this->events[$event] = new ListenersCollection();
        }

        $this->events[$event]->insert($callback, (int) $priority);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function detach($event, $callback)
    {
        if (array_key_exists($event, $this->events)) {
            $this->events[$event]->remove($callback);

            if (!count($this->events[$event])) {
                unset($this->events[$event]);
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function clearListeners($event)
    {
        if (array_key_exists($event, $this->events)) {
            $this->events[$event]->clear();
        }
    }

    /**
     * @inheritdoc
     */
    public function trigger($event, $target = null, array $params = array())
    {
        $result = true;

        if (!($event instanceof EventInterface)) {
            $event = new Event($event, $target, $params);
        }

        if (array_key_exists($event->getName(), $this->events)) {
            foreach ($this->events[$event->getName()] as $callable) {
                $result = $callable($event);

                if ($event->isPropagationStopped()) {
                    break;
                }
            }
        }

        return $result;
    }
}