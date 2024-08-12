<?php
session_start();
include('../vendor/autoload.php');

use Books\AuthorsTable;
use Books\BooksTable;
use Books\CategorysTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$key = $_GET['key'];

if (!isset($_GET['key'])) {
    HTTP::redirect('../index.php');
}


$book = new BooksTable(new MySQL());
$results = $book->search($key);
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
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Online Book Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        Search result for <b><?= htmlspecialchars($key) ?></b>
        <a href="../index.php">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>


        <div class="d-flex flex-wrap">
            <?php if (empty($results)): ?>
                <p>No books found matching your search.</p>
            <?php else: ?>
                <?php foreach ($results as $result): ?>
                    <div class="card shadow bg-secondary mt-2 p-2" style="width: 400px; margin-right: 15px;">
                        <img src="../_uploads/photos/<?= htmlspecialchars($result['cover']) ?>" alt="coverphoto" 
                            class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-light"><?= htmlspecialchars($result['title']) ?></h5>
                            <p class="card-text">
                                <i>
                                    <b>By:</b> 
                                    <?php 
                                    foreach ($author as $authors){
                                        if($authors->id == $result['author_id']){
                                            echo $authors->name;
                                            break;
                                        }
                                    }
                                    ?>
                                        
                                </i>
                            </p>
                            <p class="card-text text-light">
                                <?= htmlspecialchars($result['description']) ?>
                            </p>
                            <p class="card-text text-danger">
                                <i>
                                    <b>Category:</b> 
                                    <?php 
                                    foreach ($category as $categories){
                                        if($categories->id == $result['category_id']){
                                            echo $categories->name;
                                            break;
                                        }
                                    }
                                    ?>
                                        
                                </i>
                            </p>
                            <a href="../_uploads/file/<?= htmlspecialchars($result['file']) ?>" class="btn btn-primary">Open</a>
                            <a href="../_uploads/file/<?= htmlspecialchars($result['file']) ?>" class="btn btn-success" download="<?= htmlspecialchars($result['title']) ?>">Download</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
