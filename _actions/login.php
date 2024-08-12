<?php
session_start();
include("../vendor/autoload.php");

use Books\BooksTable;
use Libs\Database\MySQL;
use Helpers\HTTP;

$email = $_POST['email'];
$psd = $_POST['password'];

// var_dump($email);
// var_dump($psd . '<br>');

$table = new BooksTable(new MySQL);
$user = $table->login($email, $psd);

// var_dump($user);

if($user) {
    $_SESSION['user'] = $user;
    HTTP::redirect("../admin.php");
} else {
    HTTP::redirect("../index.php", "incorrect=1");
}