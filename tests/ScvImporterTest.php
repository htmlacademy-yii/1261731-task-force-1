<?php
use App\ScvImporter;
use App\SqlGenerator;
use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

require_once "../vendor/autoload.php";

$cityColumns = [
    "name",
    "lat",
    "long"
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



$citiesData = new ScvImporter("cities.csv", $cityColumns);
$citiesData->import();
print_r($citiesData->getData());

$written = new SqlGenerator("cities.sql", $citiesData);
$written->written();

//INSERT INTO users (email, password) VALUES ('vasya@mail.ru','secret');
