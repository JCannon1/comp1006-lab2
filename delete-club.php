<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Club...</title>
</head>
<body>

<?php

$club_id = null;

// 1. Get club_id from the URL, check it has a numeric value to be deleted and edited
if (!empty($_GET['club_id'])) {
    if (is_numeric($_GET['club_id'])) {
        $clubId = $_GET['club_id'];
    }
}

if (!empty($club_id)) {

    // Connect to my Azure Database
    $conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006jessecannondatabase', 'bf3c946f4d66ff', '1d953141');

    // Set up and run the SQL DELETE COMMAND
    $sql = "DELETE FROM clubs WHERE club_id = :club_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);
    $cmd->execute();

    // Disconnect from my Azure Database
    $conn = null;
}

// 5. Redirect to refresh the clubs page
header('location:clubs.php');

?>

</body>
</html>

