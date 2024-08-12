<?php
include('../vendor/autoload.php');

use Books\AuthorsTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$author = new AuthorsTable(new MySQL());
$id = $_GET['id'];

$author->delete($id);

HTTP::redirect('../admin.php');

