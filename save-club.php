<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Club...</title>
</head>
<body>

<?php
// store the form inputs into variables
$clubId = $_POST['club_id'];
$name = $_POST['name'];
$ground = $_POST['ground'];

$ok = true;

// validate the inputs 
if (empty($name)) {
    echo 'Name is required<br />';
    $ok = false;
}
if (empty($ground)) {
    echo 'Ground is required<br />';
    $ok = false;
}
if ($ok == true) {
    // connect to my Azure Database
    $conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006jessecannondatabase', 'bf3c946f4d66ff', '1d953141');

    // set up an SQL instruction to save the new club 
    if (empty($albumId)) {
        $sql = "INSERT INTO clubs (club_id, club_name, ground) VALUES (:club_name, :ground);";
    }
    else {
        $sql = "UPDATE clubs SET club_name = :club_name, ground = :club_name, ground WHERE clubId = :clubId";
    }

    // pass the input variables to the SQL command
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':club_id', $club_id, PDO::PARAM_STR, 50); 
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
    $cmd->bindParam(':ground', $ground, PDO::PARAM_STR, 50);

    if (!empty($clubId)) {
        $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);
    }

    // execute the INSERT 
    $cmd->execute();

    // disconnect from my Azure Database
    $conn = null;

    header('location:clubs.php');
}
?>

</body>
</html>
