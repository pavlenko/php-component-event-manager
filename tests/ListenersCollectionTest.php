<?php

namespace PETest\Component\EventManager;

use PE\Component\EventManager\ListenersCollection;

class ListenersCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ListenersCollection
     */
    protected $collection;

    protected function setUp()
    {
        $this->collection = new ListenersCollection();
    }

    public function testImplements()
    {
        static::assertInstanceOf(\Countable::class, $this->collection);
        static::assertInstanceOf(\IteratorAggregate::class, $this->collection);
    }

    public function testInsert()
    {
        $listener = function(){};

        static::assertCount(0, $this->collection);

        $this->collection->insert($listener);

        static::assertCount(1, $this->collection);
    }

    public function testRemove()
    {
        $listener1 = function(){};
        $listener2 = function(){};

        $this->collection->insert($listener1);
        $this->collection->insert($listener2);

        static::assertCount(2, $this->collection);

        $this->collection->remove($listener2);

        static::assertCount(1, $this->collection);
    }

    public function testClear()
    {
        $listener1 = function(){};
        $listener2 = function(){};

        $this->collection->insert($listener1);
        $this->collection->insert($listener2);

        static::assertCount(2, $this->collection);

        $this->collection->clear();

        static::assertCount(0, $this->collection);
    }

    public function testIteration()
    {
        $listener1 = function(){};
        $listener2 = function(){};

        $this->collection->insert($listener1, 10);
        $this->collection->insert($listener2, -10);

        static::assertSame([$listener2, $listener1], iterator_to_array($this->collection));
        static::assertSame([$listener2, $listener1], iterator_to_array($this->collection));
    }
}
