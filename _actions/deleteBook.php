<?php
include('../vendor/autoload.php');

use Books\BooksTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$book = new BooksTable(new MySQL());
$id = $_GET['id'];

$book->delete($id);

HTTP::redirect('../admin.php');

