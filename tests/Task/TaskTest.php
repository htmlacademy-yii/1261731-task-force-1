<?php
require_once('Task.php');
use PHPUnit\Framework\TestCase;


class TaskTest extends TestCase
{
    protected $task;

    protected function setUp() : void
    {
        $this->task = new Task(33, 44);
    }

    protected function tearDown() : void
    {
    }

    public function testGetNextStatus()
    {
        $this->assertEquals([Task::STATUS_CENCELED], $this->task->getNextStatus(Task::ACTION_CENCEL));
        $this->assertEquals([Task::STATUS_COMPLETED], $this->task->getNextStatus(Task::ACTION_COMPLETE));
        $this->assertEquals([Task::STATUS_INWORK], $this->task->getNextStatus(Task::ACTION_RESPOND));
        $this->assertEquals([Task::STATUS_FAILED], $this->task->getNextStatus(Task::ACTION_REFUSE));

    }

    public function testGetAvailableActions()
    {
        $this->assertEquals(Task::ACTION_CENCEL, $this->task->getAvailableActions(Task::STATUS_NEW, 44));
    }



}
