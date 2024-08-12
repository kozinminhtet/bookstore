<?php
include('../vendor/autoload.php');
use Libs\Database\MySQL;
use Books\CategorysTable;
use Helpers\HTTP;

$category = new CategorysTable(new MySQL());

$category->insert([
    'name' => $_POST['name'],
]);



HTTP::redirect('../admin.php');