<?php
include('../vendor/autoload.php');

use Books\BooksTable;
use Books\AuthorsTable;
use Books\CategorysTable;
use Libs\Database\MySQL;

$id = $_GET['id'];

$bookTable = new BooksTable(new MySQL);
$authorsTable = new AuthorsTable(new MySQL);
$categoryTable = new CategorysTable(new MySQL);

$book = $bookTable->find($id);
$authors = $authorsTable->all();
$categories = $categoryTable->all();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="w-50 mt-4 p-5 rounded bg-secondary shadow"> 
            <form action="../_actions/updateBook.php" method="post" enctype="multipart/form-data">
                <h3 class="text-center text-light mb-5">Edit Book</h3>

                <input type="hidden" name="id" value="<?= $book->id ?>">

                <label class="text-light">Book Title</label>
                <input type="text" class="form-control mb-2" placeholder="Book title" name="title" value="<?= $book->title ?>" required>

                <label class="text-light">Book Description</label>
                <textarea name="description" class="form-control mb-2"><?= $book->description ?></textarea>

                <label class="text-light">Book Author</label>
                <select name="author_id" class="form-select mb-2">
                    <?php foreach($authors as $author ) { ?>
                        <option value="<?= $author->id ?>" <?= ($author->id == $book->author_id) ? 'selected' : '' ?> class="bg-secondary text-light"><?= $author->name ?></option>
                    <?php } ?>
                </select>

                <label class="text-light">Book Category</label>
                <select name="category_id" class="form-select mb-2">
                    <?php foreach($categories as $category ) { ?>
                        <option value="<?= $category->id ?>" <?= ($category->id == $book->category_id) ? 'selected' : '' ?> class="bg-secondary text-light"><?= $category->name ?></option>
                    <?php } ?>
                </select>

                <div class="">
                    <label class="text-light">Cover Photo</label>
                    <input type="file" class="form-control mb-2" name="cover">
                    <input type="text" hidden class="form-control mb-2" value="<?= $book->cover ?>" name="cover_photo">
                    <a href="../_uploads/photos/<?= $book->cover ?>" hidden class="text-light mt-0">Current photo</a>
                </div>

                <div class="">
                    <label class="text-light">File</label>
                    <input type="file" class="form-control mb-2" name="file">
                    <input type="text" hidden class="form-control mb-2" value="<?= $book->file?>" name="currentFile">
                    <a href="../_uploads/file/<?= $book->file ?>" hidden class="text-light">Current file</a>
                </div>

                <input type="submit" value="Update" class="btn btn-success">
            </form> 
        </div>
    </div>
</body>
</html>
