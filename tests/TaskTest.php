<?php
use App\Task;
require_once "../vendor/autoload.php";

$task = new Task(44, 44, 15);

$nexStatus = $task->getNextStatus('action_respond');

print($nexStatus);

$object = $task->getAvailableActions($nexStatus);
print($object->getNameAction());

print_r($object);
