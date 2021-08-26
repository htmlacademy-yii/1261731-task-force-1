<?php
use App\Task;
use PHPUnit\Framework\TestCase;



class TaskTest extends TestCase
{
    protected $task;

    protected function setUp(): void
    {
        $this->task = new Task(33, 44, 15);
    }

    protected function tearDown(): void
    {

    }

    public function testGetNextStatus()
    {
        $this->assertEquals(Task::STATUS_CANCELED, $this->task->getNextStatus(Task::ACTION_CANCEL));
        $this->assertEquals(Task::STATUS_COMPLETED, $this->task->getNextStatus(Task::ACTION_COMPLETE));
        $this->assertEquals(Task::STATUS_INWORK, $this->task->getNextStatus(Task::ACTION_RESPOND));
        $this->assertEquals(Task::STATUS_FAILED, $this->task->getNextStatus(Task::ACTION_REFUSE));

    }

    public function testGetAvailableActionsForCustomer()
    {
        $this->assertEquals(Task::ACTION_CANCEL, $this->task->getAvailableActions(Task::STATUS_NEW, 44));
        $this->assertEquals(Task::ACTION_COMPLETE, $this->task->getAvailableActions(Task::STATUS_INWORK, 44));
    }

    public function testGetAvailableActionsForExecuter()
    {
        $this->assertEquals(Task::ACTION_RESPOND, $this->task->getAvailableActions(Task::STATUS_NEW, 33));
        $this->assertEquals(Task::ACTION_REFUSE, $this->task->getAvailableActions(Task::STATUS_INWORK, 33));
    }

}
