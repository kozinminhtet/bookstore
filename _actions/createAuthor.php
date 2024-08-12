<?php
include('../vendor/autoload.php');
use Libs\Database\MySQL;
use Books\AuthorsTable;
use Helpers\HTTP;

$author = new AuthorsTable(new MySQL());

$author->insert([
    'name' => $_POST['name'],
]);

HTTP::redirect('../admin.php');