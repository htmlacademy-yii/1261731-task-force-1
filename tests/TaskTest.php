<?php
use App\Task;
require_once "../vendor/autoload.php";

$task = new Task(44, 44, 15);

$nexStatus = $task->getNextStatus('Откликнуться');

print($nexStatus);

$task->getAvailableActions($nexStatus);
