<?php
use App\SqlQuery;
use App\Exceptions\SourceFileException;

require_once "../vendor/autoload.php";

$sqlQuery = new SqlQuery("cities.sql");
$sqlQuery->export();



