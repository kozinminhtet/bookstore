<?php
include('../vendor/autoload.php');
use Libs\Database\MySQL;
use Books\BooksTable;
use Helpers\HTTP;

$book = new BooksTable(new MySQL());

// for Cover photo ===>
$cover="";
$name = $_FILES['cover']['name'];
$type = $_FILES['cover']['type'];
$tmp_name = $_FILES['cover']['tmp_name'];

if($type == 'image/jpeg' or $type == "image/png") {
    $cover = $name;
    //need to check condition
    move_uploaded_file($tmp_name, "../_uploads/photos/$cover");
} else {
    HTTP::redirect("/_admins/addBook.php", "error=type"); 
}

// for file ===>
$file="";
$data = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']['tmp_name'];

if($type == 'application/pdf' 
    or $type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
    or $type == 'application/vnd.ms-powerpoint') {

    $file = $data;
    //need to check condition
    move_uploaded_file($tmp_name, "../_uploads/file/$file");
} else {
    HTTP::redirect("/_admins/addBook.php", "error=type"); 
}


$book->insert([
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'author_id' => $_POST['author_id'],
    'category_id' => $_POST['category_id'],
    'cover' => $cover,
    'file' => $file,
]);

HTTP::redirect('../admin.php');