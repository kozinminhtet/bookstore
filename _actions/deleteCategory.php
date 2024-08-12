<?php
include('../vendor/autoload.php');

use Books\CategorysTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$category = new CategorysTable(new MySQL());
$id = $_GET['id'];

$category->delete($id);

HTTP::redirect('../admin.php');

