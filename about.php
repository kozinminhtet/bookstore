<?php
include('vendor/autoload.php');

use Books\AuthorsTable;
use Books\BooksTable;
use Books\CategorysTable;
use Helpers\HTTP;
use Libs\Database\MySQL;



$book = new BooksTable(new MySQL());
$results = $book->AuthorAll();
$authors = new AuthorsTable(new MySQL());
$author = $authors->all();
$categories = new CategorysTable(new MySQL());
$category = $categories->all();

// var_dump($results);
// echo $key;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Online Book Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>HELLO ABOUT</h1>
    </div>
</body>
</html>
