<?php
include('../vendor/autoload.php');

use Books\CategorysTable;
use Helpers\HTTP;
use Libs\Database\MySQL;

$categoryTable = new CategorysTable(new MySQL());

$id = $_GET['id'];
$category = $categoryTable->find($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $categoryTable->update($id, $name);
    HTTP::redirect('../admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Category</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category->name) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
