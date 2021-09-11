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

$usersColumns = [
    "email",
    "name",
    "password",
    "dt_add"
];



$categoriesData = new ScvImporter("users.csv", $usersColumns);
$categoriesData->import();
print_r($categoriesData->getData());

$written = new SqlGenerator("users.sql", $categoriesData);
$written->written();

//INSERT INTO users (email, password) VALUES ('vasya@mail.ru','secret');
