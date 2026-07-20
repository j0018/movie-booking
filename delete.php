<?php
require_once "database_Connection.php";

if (isset($_POST['record_id'], $_POST['record_type'])) {
    $id = (int) $_POST['record_id']; // cast to int to sanitize
    $type = $_POST['record_type'];
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'adminPage_Dashboard.php';

    if ($type === 'user') {
        $deletesql = "DELETE FROM user WHERE user_id = $id";
        $ID = $_SESSION['user_id'];

        $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Deleted User',NOW(),'".$UserType."')";
        $conn->query($logssql);

    } elseif ($type === 'movie') {
        $deleteShowtimes = "DELETE FROM showtime WHERE movie_id = $id";
        $conn->query($deleteShowtimes);
    
        $deletesql = "DELETE FROM movie WHERE movie_id = $id";
        $result = $conn->query($deletesql);

        $ID = $_SESSION['user_id'];
        $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Deleted Movie',NOW(),'".$UserType."')";
        $conn->query($logssql);

    } elseif ($type === 'theater') {
        $deleteShowtimes = "DELETE FROM showtime WHERE theater_id = $id";
        $conn->query($deleteShowtimes);
    
        $deletesql = "DELETE FROM theater WHERE theater_id = $id";
        $result = $conn->query($deletesql);

        $ID = $_SESSION['user_id'];
        $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Deleted Theater',NOW(),'".$UserType."')";
        $conn->query($logssql);

        if ($conn->query($deletesql) === TRUE) {
        // Successful deletion
    } else {
        die("Delete failed: " . $conn->error);
    }
    } else {
        die("Invalid record type");
    }

    $conn->query($deletesql);
     header("Location: $redirect");
    exit;
}
?>

$deleteShowtimes = "DELETE FROM showtime WHERE movie_id = '".$_POST['record_id']."'";
    $conn->query($deleteShowtimes);
    
    // Then delete the movie
    $deleteSql = "DELETE FROM movie WHERE movie_id = '".$_POST['record_id']."'";
    $result = $conn->query($deleteSql);