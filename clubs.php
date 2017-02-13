<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clubs</title>
    <!-- CSS links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<h1>Clubs</h1>
<a href="club-details.php">Add a New Club</a>

<?php
// connect to my Azure Database 
$conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006jessecannondatabase', 'bf3c946f4d66ff', '1d953141');

// set up query 
$sql = "SELECT club_id, club_name, ground FROM clubs ORDER BY club_name";

// run query and store club names and ground results
$cmd = $conn->prepare($sql);
$cmd->execute();
$clubs = $cmd->fetchAll();

// start table and headings
echo '<table class="table table-striped table-hover">
<tr><th>Name</th><th>Ground</th><th>Edit</th><th>Delete</th></tr>';

// loop through data
foreach ($clubs as $club) {
    // show each club as a new row
    echo '<tr><td>' . $club['club_name'] . '</td>
        <td>' . $club['ground'] . '</td>
        <td><a href="club-details.php?club_id=' . $club['club_id'] . '" class="btn btn-primary">Edit</a></td>
        <td><a href="delete-club.php?club_id=' . $club['club_id'] . '"
        class="btn btn-danger confirmation">Delete</a></td></tr>';
}

// end table
echo '</table>';

// disconnect from my Azure Database
$conn = null;
?>

<!-- JavaScript links -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- my custom js to ask the user if they are sure they want to delete the club from the table -->
<script src="js/app.js"></script>

</body>
</html>