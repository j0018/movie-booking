<?php
include 'database_Connection.php';  

$type = isset($_POST['type']) ? $_POST['type'] : '';
$redirect = isset($_POST['redirect2']) ? $_POST['redirect2'] : 'adminPage_Dashboard.php';



$sql = "";

if ($type == 'user') {
    $id = $_POST['user_id'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE user SET 
                full_name = '$name', 
                email = '$email', 
                role = '$role' 
            WHERE user_id = $id";

$ID = $_SESSION['user_id'];
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Updated User Details',NOW(),'".$UserType."')";
    $conn->query($logssql);


} elseif ($type == 'movie') {
    $id = $_POST['movie_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $h = $_POST['h'];
    $m = $_POST['m'];
    $s = $_POST['s'];
    $duration = $h.":".$m.":".$s;
    $release_date = $_POST['release_date'];
    $description = $_POST['description'];

    $sql = "UPDATE movie SET 
                title = '$title', 
                genre = '$genre', 
                duration = '$duration',
                release_date = '$release_date',
                description = '$description' 
            WHERE movie_id = $id";

    $ID = $_SESSION['user_id'];
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Updated Movie Details',NOW(),'".$UserType."')";
    $conn->query($logssql);

} elseif ($type == 'theater') {
    $id = $_POST['theater_id'];
    $name = $_POST['theater_name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE theater SET 
                theater_name = '$name', 
                location = '$location', 
                capacity = $capacity 
            WHERE theater_id = $id";
    $ID = $_SESSION['user_id'];
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Updated Theater Details',NOW(),'".$UserType."')";
    $conn->query($logssql);

} elseif ($type == 'showtime') {
    $id = $_POST['showtime_id'];
    $movie_id = $_POST['movie_id'];
    $theater_id = $_POST['theater_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];

    $sql = "UPDATE showtimes SET 
                movie_id = $movie_id, 
                theater_id = $theater_id, 
                show_date = '$show_date', 
                show_time = '$show_time' 
            WHERE id = $id";
            $ID = $_SESSION['user_id'];
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Updated Showtime Details',NOW(),'".$UserType."')";
    $conn->query($logssql);
} else {
    echo "Invalid type.";
    exit;
}


if (!empty($sql)) {
    if ($conn->query($sql) === TRUE) {
        header("Location: $redirect");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
