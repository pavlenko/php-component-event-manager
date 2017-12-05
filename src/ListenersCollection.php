<?php

namespace PE\Component\EventManager;

/**
 * Helper class to maintain listeners priority
 */
class ListenersCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var callable[]
     */
    private $listeners = [];

    /**
     * @var int[]
     */
    private $priorities = [];

    /**
     * @var bool
     */
    private $sorted = false;

    /**
     * @param callable $callback
     * @param int      $priority
     */
    public function insert($callback, $priority = 0)
    {
        // Ensure listener is unique in collection
        $this->remove($callback);

        $this->listeners[]  = $callback;
        $this->priorities[] = $priority;

        $this->sorted = false;
    }

    /**
     * Remove callable from collection
     *
     * @param callable $callback
     */
    public function remove($callback)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($callback === $listener) {
                unset($this->listeners[$index], $this->priorities[$index]);
                $this->sorted = false;
            }
        }
    }

    /**
     * Clear collection
     */
    public function clear()
    {
        $this->listeners = $this->priorities = [];
    }

    /**
     * Get collection count
     *
     * @inheritDoc
     */
    public function count()
    {
        return count($this->listeners);
    }

    /**
     * Allow to loop collection through foreach
     *
     * @inheritDoc
     */
    public function getIterator()
    {
        $this->sort();
        return new \ArrayIterator($this->listeners);
    }

    /**
     * Sort collection by priority
     */
    private function sort()
    {
        if ($this->sorted) {
            return;
        }

        array_multisort($this->priorities, SORT_ASC, $this->listeners);
        $this->sorted = true;
    }
}