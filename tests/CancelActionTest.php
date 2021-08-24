<?php
use App\CancelAction;
require_once "../vendor/autoload.php";

$test = new CancelAction;
$checkAccess = $test->validateAccessUser(44, 44, 55);
$getNameAction = $test->getNameAction();
$getAlterNameAction = $test->getInnerNameAction();

$results = [
    $checkAccess,
    $getAlterNameAction,
    $getNameAction
];

foreach ($results as $result) {
    print($result);
    print("-");
}

