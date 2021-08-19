<?php
require_once "../../src/CencelAction.php";


$test = new CencelAction;
$result = $test->validateAccessUser(44, 4, 55);
print($result);
