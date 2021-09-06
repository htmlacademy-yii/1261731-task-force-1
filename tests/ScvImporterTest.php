<?php
use App\ScvImporter;
use App\SqlGenerator;
use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

require_once "../vendor/autoload.php";

$categoriesColumns = [
    "name",
    "icon"
];

$tasksColumns = [
    "dt_add",
    "category_id",
    "description",
    "expire",
    "name",
    "address",
    "budget",
    "lat",
    "long"
];

function getData(string $filename, array $columns) {
    $getDataTest = new ScvImporter($filename, $columns);
    $getDataTest->import();
    return $getDataTest ->getData();
};

$categoriesData = getData("categories.csv", $categoriesColumns);

$written = new SqlGenerator("categories.sql", "123");
$written->written();
