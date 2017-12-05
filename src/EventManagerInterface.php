<?php

namespace PE\Component\EventManager;

/**
 * @TODO remove after PSR-14 accepted
 */
interface EventManagerInterface
{
    /**
     * Attaches a listener to an event
     *
     * @param string   $event    The event to attach too
     * @param callable $callback A callable function
     * @param int      $priority The priority at which the $callback executed
     *
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = 0);

    /**
     * Detaches a listener from an event
     *
     * @param string   $event    The event to attach too
     * @param callable $callback A callable function
     *
     * @return bool true on success false on failure
     */
    public function detach($event, $callback);

    /**
     * Clear all listeners for a given event
     *
     * @param string $event
     */
    public function clearListeners($event);

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param string|EventInterface $event
     * @param object|string         $target
     * @param array                 $params
     *
     * @return mixed
     */
    public function trigger($event, $target = null, array $params = array());
}