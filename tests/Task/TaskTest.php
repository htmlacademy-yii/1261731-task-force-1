<?php
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private $task;

    protected function setUp() : void
    {
        $this->task = new \Task(33, 44);
    }

    protected function tearDown() : void
    {
    }

    public function testGetNextStatus()
    {
        $this->assertEquals(1, $this->task->getNextStatus(1));


    }
}
