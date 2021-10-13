<?php
use App\ScvImporter;
use App\SqlGenerator;
use App\SqlRepiesGenerator;
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
    "icon",
    "created_at",
    "updated_at"
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
    "created_at",
    "updated_at"
];

$repliesColumns = [
    "created_at",
    "cost",
    "comment",
    "user_id",
    "task_id",
    "updated_at"
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
createFiles("users.csv", $usersColumns);

$repliesData = new ScvImporter("replies.csv", $repliesColumns);
$repliesData->import();
$repliesData->getData();
$createSqlRepliesFile = new SqlRepiesGenerator("replies.sql", $repliesData, $repliesColumns);
$createSqlRepliesFile->written();
