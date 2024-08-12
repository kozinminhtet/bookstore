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
                            <a class="nav-link" href="_actions/loginform.php">Login</a>
                        </li>
                    </ul>
                </div>
                
                <?php if(isset($_GET['incorrect'])): ?>
                    <div class="alert alert-warning">
                        incorrect email or password
                    </div>
                <?php endif ?>
            </div>
        </nav>

        <form action="_actions/search.php" method="get" 
                class="d-flex mt-5 mb-5" role="search" 
                style="width: 400px;">
            <input class="form-control me-1" name="key" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>

        <div class="d-flex mt-5">
            <div class="d-flex flex-wrap">
                <?php foreach ($results as $result): ?>
                    <div class="card shadow bg-secondary mt-2 p-1" style="width: 350px; margin-right: 15px;">
                        <img src="_uploads/photos/<?= htmlspecialchars($result->cover) ?>" alt="coverphoto" 
                            class="card-img-top" height="350px">
                        <div class="card-body">
                            <h5 class="card-title text-light"><?= htmlspecialchars($result->title) ?></h5>
                            <p class="card-text">
                                <i>
                                    <b>By:</b> 
                                    <?php 
                                    foreach ($author as $authors){
                                        if($authors->id == $result->author_id){
                                            echo $authors->name;
                                        }
                                    }
                                    ?>
                                        
                                </i>
                            </p>
                            <p class="card-text text-light">
                                <?= htmlspecialchars($result->description) ?>
                            </p>
                            <p class="card-text text-danger">
                                <i>
                                    <b>Category:</b> 
                                    <?php 
                                    foreach ($category as $categories){
                                        if($categories->id == $result->category_id){
                                            echo $categories->name;
                                        }
                                    }
                                    ?>
                                        
                                </i>
                            </p>
                            <a href="_uploads/file/<?= htmlspecialchars($result->file) ?>" class="btn btn-primary">Open</a>
                            <a href="_uploads/file/<?= htmlspecialchars($result->file) ?>" class="btn btn-success" download="<?= htmlspecialchars($result->title) ?>">Download</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="">
                <ul class="list-group">
                    <li class="list-group-item active">Category</li>
                    <?php foreach ($category as $categories) : ?>
                        <a href="_actions/category.php?id=<?= $categories->id ?>" class="list-group-item">
                            <?php echo $categories->name ?>
                        </a>
                    <?php endforeach ?>    
                </ul>
                <ul class="list-group mt-5">
                    <li class="list-group-item active">Author</li>
                    <?php foreach ($author as $authors) : ?>
                        <a href="_actions/author.php?id=<?= $authors->id ?>" class="list-group-item">
                            <?php echo $authors->name ?>
                        </a>
                    <?php endforeach ?>    
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
