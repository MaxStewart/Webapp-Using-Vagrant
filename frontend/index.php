<!DOCTYPE html>
<html>
<head>
<title>Frontend</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<?php

$db_host = '192.168.33.14';
$db_name = 'fvision';
$db_user = 'webuser';
$db_pass = 'Alexander';

$categoryErrorString = "";

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_pass);

/*
$query = $pdo->query("SELECT * FROM categories");

while($row = $query->fetch()){
    echo "<tr><td>".$row["name"]."</td></tr>\n";
}*/

if(isset($_POST['submitCategories'])){

    // Check the submission was not empty
    if($_POST['categoryName'] === ""){
        $categoryErrorString = "Please enter a value";
    }
    // Submission contains text we can check
    else {
        $isValid = true;

        $query = $pdo->query("SELECT * FROM categories");

        // Loop and check the category doesn't exist in DB
        while ($row = $query->fetch()) {
            $dbresult = strtolower($row["name"]);
            $match = strtolower($_POST['categoryName']);
            if ($dbresult === $match) {
                $categoryErrorString = "Category already exists";
                $isValid = false;
            }
        }
        if ($isValid) {
            $sql = "INSERT INTO categories VALUES ('$_POST[categoryName]')";
            $pdo->exec($sql);
        }
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SpendTrack Frontend</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="http://127.0.0.1:10122/">Backend</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row justify-content-center">
        <form name="add-spend-form" method="post" id="add-spend-form">
            <p class="h4 mb-4 text-center">Add Purchase</p>
            <div class="row">
                <div class="col">
                    <label for="taskName">Purchase Name:</label>
                    <input id="taskName" name="taskName" type="text" class="form-control" placeholder="Item Name">
                </div>
                <div class="col">
                    <label for="dueDate">Purchase date:</label>
                    <input id="dueDate" name="dueDate" type="date" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="purchaseAmount">Purchase Amount:</label>
                    <input id="purchaseAmount" name="purchaseAmount" type="number" class="form-control" placeholder="$">
                </div>
                <div class="col">
                    <label for="category">Category:</label>
                    <select name="category" class="form-control">
                        <?php
                            $query = $pdo->query("SELECT * FROM categories");
                            while ($row = $query->fetch()) {
                                echo  "<option value=$row[name]>$row[name]</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="taskNotes">Notes: </label>
                <textarea type="textarea" id="taskNotes" name="taskNotes" class="form-control" rows="3" cols="10"></textarea>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Add Spend</button>
        </form>
    </div>
</div>
<hr>
<div class="container-fluid">
    <div class="row justify-content-center">
        <form name="add-category-form" method="post" id="add-category-form">
            <p class="h4 mb-4 text-center">Add Category</p>
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <input id="categoryName" name="categoryName" type="text" class="form-control" placeholder="Category Name">
            </div>
            <?php
                if($categoryErrorString !== ""){
                    echo "<p>$categoryErrorString</p>";
                }
            ?>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submitCategories">Add Category</button>
        </form>
    </div>
</div>

</body>
</html>