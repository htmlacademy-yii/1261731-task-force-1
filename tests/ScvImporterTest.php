<?php
use App\ScvImporter;
use App\SqlGenerator;
use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

require_once "../vendor/autoload.php";

$cityColumns = [
    "name",
    "lat",
    "longe",
    "created_at",
    "updated_at"
];

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

$usersColumns = [
    "email",
    "name",
    "password",
    "dt_add"
];


function createFiles(string $fileCvs, array $columns) {
    $citiesData = new ScvImporter($fileCvs, $columns);
    $citiesData->import();
    $citiesData->getData();

    $sqlFileName = str_replace('.csv', '.sql', $fileCvs);

    $written = new SqlGenerator($sqlFileName, $citiesData, $columns);
    $written->written();
}

createFiles("cities.csv", $cityColumns);
createFiles("categories.csv", $categoriesColumns);
