<?php
use App\Task;
use App\Exceptions\ActionWrongException;

require_once "../vendor/autoload.php";

$task = new Task(44, 44, 15);

try {
    $nexStatus = $task->getNextStatus('action_respond');
}
catch (ActionWrongException $e) {
    error_log($e->getMessage());
}

print($nexStatus);

try {
    $object = $task->getAvailableActions($nexStatus);
}
catch (StatusWrongException $e) {
    error_log($e-getMessage());
}

print($object->getNameAction());

print_r($object);
