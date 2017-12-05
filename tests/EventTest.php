<?php

namespace PETest\Component\EventManager;

use PE\Component\EventManager\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $event = new Event('foo');

        static::assertNull($event->getTarget());
        static::assertSame([], $event->getParams());

        $event = new Event('foo', $target = new \stdClass(), $params = ['bar' => 'baz']);

        static::assertSame($target, $event->getTarget());
        static::assertSame($params, $event->getParams());
    }

    public function testName()
    {
        $event = new Event('eee');

        static::assertSame('eee', $event->getName());

        $event->setName('fff');

        static::assertSame('fff', $event->getName());
    }

    public function testTarget()
    {
        $event = new Event('eee');

        $event->setTarget($target1 = new \stdClass());

        static::assertSame($target1, $event->getTarget());

        $event->setTarget($target2 = new \stdClass());

        static::assertSame($target2, $event->getTarget());
    }

    public function testParams()
    {
        $event = new Event('eee');

        $event->setParams(['foo' => 'bar']);

        static::assertSame('bar', $event->getParam('foo'));
        static::assertNull($event->getParam('baz'));
    }

    public function testPropagationStopped()
    {
        $event = new Event('eee');

        static::assertFalse($event->isPropagationStopped());

        $event->stopPropagation(true);

        static::assertTrue($event->isPropagationStopped());

        $event->stopPropagation(false);

        static::assertFalse($event->isPropagationStopped());
    }
}
