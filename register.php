<?php
include("vendor/autoload.php");

use Books\AuthorsTable;
use Libs\Database\MySQL;
use Books\BooksTable;

$table = new BooksTable(new MySQL());
$author = new AuthorsTable(new MySQL());

 echo "Seeding started....<br>";

 $table->insert([
    "title" => "Professional Web Developer",
    "author_id" => 2,
    "description" => "You should learn after basic course",
    "category_id" => 2,
    "cover" => "cover",
    "file" => "file"
 ]);

 echo "Seeding completed. <br>";

// $author->insert([
//     "name" => "Ei Maung",
//     "author_id" => 2,
// ]);