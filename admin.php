<?php
include('vendor/autoload.php');

use Books\AuthorsTable;
use Books\BooksTable;
use Books\CategorysTable;
use Helpers\Auth;
use Libs\Database\MySQL;

Auth::check();

// var_dump($auth);

$table = new BooksTable(new MySQL);
$authors = new AuthorsTable(new MySQL());
$category = new CategorysTable(new MySQL());

$bookAuthor = $table->AuthorAll();
$categories = $category->all();
$author = $authors->all();
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
                <a class="navbar-brand" href="#">Admin</a>
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
                            <a class="nav-link" href="_admins/addBook.php">
                                Add Book
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="_admins/addCategory.php">
                                Add Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="_admins/addAuthor.php">
                                Add Author
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
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


        <!-- All Books -->
        <div class="mt-3">
            <?php if(empty($bookAuthor)) : ?>
                <?php echo "Empty Any Book" ?>
            <?php else : ?>
                <h4>All Books</h4>
                <table class="table table-bordered ">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>

                    <?php $i=0 ?>
                    <?php foreach($bookAuthor as $book) : ?>
                        <?php $i++; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <img src="_uploads/photos/<?= $book->cover ?>" alt="cover" width="100" height="150">
                                <div>
                                    <a href="_uploads/file/<?= $book->file ?>" class="file"><?= $book->title ?></a>
                                </div>
                            </td>
                            <td>   
                                <?php 
                                //to study this section => $author == 1
                                    if(empty($author)) {
                                        echo "Undefine";
                                    }else {
                                        foreach($author as $authorr){
                                            if($authorr->id == $book->author_id){
                                                echo $authorr->name;
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $book->description ?></td>
                            <td>
                                <?php 
                                //to study this section => $categories == 0
                                    if(empty($categories)){
                                        echo "Undefine";
                                    }else {
                                        foreach($categories as $category){
                                            if($category->id == $book->category_id){
                                                echo $category->name;
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="_actions/deleteBook.php?id=<?= $book->id ?>" class="btn btn-danger">Del</a>
                                <a href="_admins/editBook.php?id=<?= $book->id ?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>

                            <!-- All Authors -->
        <div class="mt-5" >
            <?php if(empty($author)) : ?>
                <?php echo "Empty Author" ?>
            <?php else : ?>
                <h4>All Authors</h4>
                <table class="table table-bordered ">
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                        
                    <?php $j=0 ?>
                    <?php foreach($author as $authorr) : ?>

                        <?php $j++; ?>
                        <tr>
                            <td><?= $j ?></td>
                            <td>   
                                <?php 
                                echo $authorr->name;
                                ?>
                            </td>
                            <td>
                                <a href="_actions/deleteAuthor.php?id=<?= $authorr->id ?>" class="btn btn-danger">Del</a>
                                <a href="_actions/updateAuthor.php?id=<?= $authorr->id ?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>    
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
                            <!-- All Category -->
        <div class="mt-5">
            <?php if(empty($categories)) : ?>
                <?php echo "Empty Category" ?>
            <?php else :?>
                <h4>All Categories</h4>
                <table class="table table-bordered ">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    <?php $j=0 ?>
                    <?php foreach($categories as $category) : ?>
                        <?php $j++; ?>
                        <tr>
                            <td><?= $j ?></td>
                            <td>   
                                <?php
                                    if (empty($categories)) {
                                    } else {
                                        echo $category->name;
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="_actions/deleteCategory.php?id=<?= $category->id ?>" class="btn btn-danger">Del</a>
                                <a href="_admins/updateCategory.php?id=<?= $category->id ?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
    </div>
</body>
</html>

