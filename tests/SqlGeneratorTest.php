<?php
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
    $getDataTest = new SqlGenerator($filename, $columns);
    $getDataTest->import();
    return $getDataTest ->getData();
};

$getCategoriesData = getData("..\data\categories.csv", $categoriesColumns);
print_r($getCategoriesData);
