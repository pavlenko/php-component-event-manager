<?php

namespace PE\Component\EventManager;

/**
 * @TODO update after PSR-14 accepted
 */
class Event implements EventInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string|object
     */
    private $target;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var bool
     */
    private $propagationStopped = false;

    /**
     * Event constructor.
     *
     * @param string             $name
     * @param null|object|string $target
     * @param array              $params
     */
    public function __construct($name, $target = null, array $params = [])
    {
        $this->name   = $name;
        $this->target = $target;
        $this->params = $params;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @inheritdoc
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @inheritdoc
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @inheritdoc
     */
    public function getParam($name)
    {
        return array_key_exists($name, $this->params) ? $this->params[$name] : null;
    }

    /**
     * @inheritdoc
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @inheritdoc
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @inheritdoc
     */
    public function stopPropagation($flag)
    {
        $this->propagationStopped = (bool) $flag;
    }

    /**
     * @inheritdoc
     */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }
}