<?php
include('../vendor/autoload.php');

use Books\AuthorsTable;
use Books\BooksTable;
use Books\CategorysTable;
use Libs\Database\MySQL;

$table = new BooksTable(new MySQL);
$authors = new AuthorsTable(new MySQL());
$category = new CategorysTable(new MySQL());

$bookAuthor = $table->AuthorAll();
$categories = $category->all();
$author = $authors->all();


// var_dump($books);
// var_dump($bookAuthor);

// var_dump($categories);
// var_dump($author);


// foreach($author as $authors){
//     echo $authors->name . "<br/>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addAuthor</title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../admin.php">Admin</a>
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
                            <a class="nav-link" href="addBook.php">
                                Add Book
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addCategory.php">
                                Add Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addAuthor.php">
                                Add Author
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="w-50 mt-4 p-5 rounded bg-secondary shadow"> 
            <form action="../_actions/createBook.php" method="post" enctype="multipart/form-data">
                <h3 class="text-center text-light mb-5">Add New Book</h3>

                <?php if(isset($_GET['error'])) :?>
                    <div class="alert alert-danger">
                        Unable to upload this file!
                    </div>
                <?php endif ?>

                <label class="text-light">Book Title</label>
                <input type="text" class="form-control mb-2" placeholder="Book title" name="title" required>

                <label class="text-light">Book Description</label>
                <textarea name="description" class="form-control mb-2"></textarea>

                <!-- need selected function in select -->
                <label class="text-light">Book Author</label>
                <select name="author_id" class="form-select mb-2">
                    <?php foreach($author as $authors ) { ?>
                    <option value="<?= $authors->id ?>" class="bg-secondary text-light"><?= $authors->name ?></option>
                    <?php } ?>
                </select>

                <label class="text-light">Book Category</label>
                <select name="category_id" class="form-select mb-2">
                    <!-- <option class="">Select Category</option> -->
                    <?php foreach($categories as $category ):?>
                    <option value="<?= $category->id ?>" class="bg-secondary text-light"><?= $category->name ?></option>
                    <?php endforeach ?>
                </select>

                <label class="text-light">Cover Photo</label>
                <input type="file" class="form-control mb-2" name="cover">

                <label class="text-light">File</label>
                <input type="file" class="form-control mb-2" name="file">
                
                <input type="submit" value="Submit" class="btn btn-success">
            </form> 
        </div>
    </div>
</body>
</html>