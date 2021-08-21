<?php
use App\Task;
require_once "../vendor/autoload.php";

$task = new Task(44, 32, 15);

$task->getNextStatus('Откликнуться');
