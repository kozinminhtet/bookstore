<?php
include('../vendor/autoload.php');

use Books\BooksTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$author_id = $_POST['author_id'];
$category_id = $_POST['category_id'];
$cover = $_FILES['cover']['name'];
$file = $_FILES['file']['name'];

$currentCover = $_POST['cover_photo'];
$currentFile = $_POST['currentFile'];

if ($cover) {
    move_uploaded_file($_FILES['cover']['tmp_name'], '../_uploads/photos/' . $cover);
} else {
    $cover = $currentCover; // Use existing cover if no new cover is uploaded
}

if($file) {
    move_uploaded_file($_FILES['file']['tmp_name'], '../_uploads/file/' . $file);
} else {
    $file = $currentFile;
}


$bookTable = new BooksTable(new MySQL);
$bookTable->updateBook($id, $title, $description, $author_id, $category_id, $cover, $file);

HTTP::redirect('../admin.php');
?>
