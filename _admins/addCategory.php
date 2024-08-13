<?php
include('../vendor/autoload.php');

use Helpers\Auth;

Auth::check();

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



        <div class="w-50 mt-5 p-5 rounded bg-secondary shadow"> 
            <form action="../_actions/createCategory.php" method="post">
                <h3 class="text-center text-light mb-5">Add New Category</h3>

                <label class="text-light">Category Name</label>
                <input type="text" class="form-control mb-2" placeholder="Add Category" name="name" required>

                <input type="submit" value="Submit" class="btn btn-success">
            </form> 
        </div>
    </div>
</body>
</html>