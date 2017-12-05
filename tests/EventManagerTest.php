<?php

namespace PETest\Component\EventManager;

use PE\Component\EventManager\EventInterface;
use PE\Component\EventManager\EventManager;

class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $calledA = false;
    protected $calledB = false;

    /**
     * @var EventManager
     */
    private $manager;

    protected function setUp()
    {
        $this->calledA = false;
        $this->calledB = false;
        $this->manager = new EventManager();
    }

    public function testTrigger()
    {
        $this->manager->attach('foo', function(EventInterface $event){
            $this->calledA = true;
        });

        $this->manager->attach('foo', function(EventInterface $event){
            $this->calledB = true;
        });

        $this->manager->trigger('foo');

        static::assertTrue($this->calledA);
        static::assertTrue($this->calledB);
    }

    public function testTriggerWithStopPropagation()
    {
        $this->manager->attach('foo', function(EventInterface $event){
            $this->calledA = true;
            $event->stopPropagation(true);
        });

        $this->manager->attach('foo', function(EventInterface $event){
            $this->calledB = true;
        });

        $this->manager->trigger('foo');

        static::assertTrue($this->calledA);
        static::assertFalse($this->calledB);
    }

    public function testDetachSingleListener()
    {
        $this->manager->attach('foo', $functionA = function(EventInterface $event){
            $this->calledA = true;
        });

        $this->manager->attach('foo', $functionB = function(EventInterface $event){
            $this->calledB = true;
        });

        $this->manager->detach('foo', $functionA);

        $this->manager->trigger('foo');

        static::assertFalse($this->calledA);
        static::assertTrue($this->calledB);
    }

    public function testDetachMultipleListeners()
    {
        $this->manager->attach('foo', $functionA = function(EventInterface $event){
            $this->calledA = true;
        });

        $this->manager->attach('foo', $functionB = function(EventInterface $event){
            $this->calledB = true;
        });

        $this->manager->detach('foo', $functionA);
        $this->manager->detach('foo', $functionB);

        $this->manager->trigger('foo');

        static::assertFalse($this->calledA);
        static::assertFalse($this->calledB);
    }

    public function testClearListeners()
    {
        $this->manager->attach('foo', $functionA = function(EventInterface $event){
            $this->calledA = true;
        });

        $this->manager->attach('foo', $functionB = function(EventInterface $event){
            $this->calledB = true;
        });

        $this->manager->clearListeners('foo');

        $this->manager->trigger('foo');

        static::assertFalse($this->calledA);
        static::assertFalse($this->calledB);
    }
}
