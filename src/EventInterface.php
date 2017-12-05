<?php

namespace PE\Component\EventManager;

/**
 * @TODO remove after PSR-14 accepted
 */
interface EventInterface
{
    /**
     * Get event name
     *
     * @return string
     */
    public function getName();

    /**
     * Set the event name
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get target/context from which event was triggered
     *
     * @return null|string|object
     */
    public function getTarget();

    /**
     * Set the event target
     *
     * @param null|string|object $target
     */
    public function setTarget($target);

    /**
     * Get a single parameter by name
     *
     * @param  string $name
     *
     * @return mixed
     */
    public function getParam($name);

    /**
     * Get parameters passed to the event
     *
     * @return array
     */
    public function getParams();

    /**
     * Set event parameters
     *
     * @param array $params
     */
    public function setParams(array $params);

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param bool $flag
     */
    public function stopPropagation($flag);

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
    public function isPropagationStopped();
}