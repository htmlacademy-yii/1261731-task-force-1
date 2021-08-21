<?php
use App\CencelAction;
require_once "../vendor/autoload.php";

$test = new CencelAction;
$checkAccess = $test->validateAccessUser(44, 44, 55);
$getNameAction = $test->getNameAction();
$getAlterNameAction = $test->getAlterNameAction();

$results = [
    $checkAccess,
    $getAlterNameAction,
    $getNameAction
];

foreach ($results as $result) {
    print($result);
    print("-");
}

