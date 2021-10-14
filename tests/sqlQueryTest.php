<?php
use App\SqlQuery;
use App\Exceptions\SourceFileException;

require_once "../vendor/autoload.php";

$sqlQuery = new SqlQuery;
//$sqlQuery->export("cities.sql");
//$sqlQuery->export("categories.sql");
//$sqlQuery->export("users.sql");
//$sqlQuery->export("tasks.sql");
$sqlQuery->export("replies.sql");



