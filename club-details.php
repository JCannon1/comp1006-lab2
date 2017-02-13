<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Club Details</title>
    <!-- CSS links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<?php
// check the URL for a club_id incase the user clicked the edit button
$club_id = null;
$club_name = null;
$ground = null;

if (!empty($_GET['club_id'])) {
    if (is_numeric($_GET['club_id'])) {
        // we have a numeric clubId in the URL
        $albumId = $_GET['club_id'];

        // connect to my Azure Database
        $conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006jessecannondatabase', 'bf3c946f4d66ff', '1d953141');

        $sql = "SELECT club_name, ground, FROM clubs WHERE club_id = :club_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':club_id', $club_id, PDO::PARAM_INT);
        $cmd->execute();
        $album = $cmd->fetch();

        // populate the club values into variables
        $club_id = $club['club_id'];
        $club_name = $club['club_name'];
        $ground = $club['ground'];

        // disconnect from my Azure Database
        $conn = null;
    }
}

?>

<main class="container">
    <h1>Club Details</h1>
    <a href="clubs.php">View Clubs</a>

    <form method="post" action="save-club.php">
        <fieldset class="form-group">
            <label for="club_name" class="col-sm-1">Name: *</label>
            <input name="club_name" id="club_name" required placeholder="Club Name" value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="ground" class="col-sm-1">Ground:</label>
            <input name="ground" id="ground" type="ground" placeholder="Ground" value="<?php echo $ground; ?>" />
        </fieldset>
        <input name="club_id" id="club_id" value="<?php echo $club_id; ?>" type="hidden" />
        <button class="btn btn-success col-sm-offset-1">Save</button>
    </form>

</main>
<!-- JavaScript links -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- my custom js to ask the user if they are sure they want to delete the club from the table -->
<script src="js/app.js"></script>

</body>
</html>
