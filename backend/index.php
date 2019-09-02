<?php

$dataPoints = array(
    array("y" => 25, "label" => "Sunday"),
    array("y" => 15, "label" => "Monday"),
    array("y" => 25, "label" => "Tuesday"),
    array("y" => 5, "label" => "Wednesday"),
    array("y" => 10, "label" => "Thursday"),
    array("y" => 0, "label" => "Friday"),
    array("y" => 20, "label" => "Saturday")
);

?>

<!DOCTYPE html>
<html>
<head>

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Push-ups Over a Week"
                },
                axisY: {
                    title: "Number of Push-ups"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

    <title>Backend</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Chart -->


    <!--
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    -->
</head>
<body>

<?php

$db_host = '192.168.33.14';
$db_name = 'fvision';
$db_user = 'webuser';
$db_pass = 'Alexander';

$categoryErrorString = "";
$spendErrorString = "";

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_pass);

/*
$query = $pdo->query("SELECT * FROM categories");

while($row = $query->fetch()){
    echo "<tr><td>".$row["name"]."</td></tr>\n";
}*/
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SpendTrack</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="http://127.0.0.1:10222/">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="index.php">Spending Graph</a>
        </div>
    </div>
</nav>

<h1>Spending Graph</h1>
<p><a href="http://127.0.0.1:10222/">Add Spending</a></p>

<div class="container">
    <div class="row justify-content-center">
        <form name="add-spend-form" method="post" id="add-spend-form">
            <p class="h4 mb-4 text-center">Select Graph Interval</p>
            <div class="form-row">
                <div class="col">
                    <select name="interval" class="form-control form-control-sm">
                        <option value="weekly">Weekly</option>
                        <option value="daily">Daily</option>
                        <option value="yearly">Yearly</option>
                        <option value="lifetime">Lifetime</option>
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-primary btn-sm" type="submit" name="submitInterval">Graph</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>