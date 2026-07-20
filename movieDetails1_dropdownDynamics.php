<?php
require_once "database_Connection.php";

if(isset($_GET['theater_id']) && isset($_GET['movie_id']) && !isset($_GET['show_date'])){
    $theater_id = $_GET['theater_id'];
    $movie_id = $_GET['movie_id'];
    
    $showdateSQL = "Select distinct show_date from showtime where theater_id = $theater_id and movie_id = $movie_id";
    $showdateResult = $conn->query($showdateSQL);

    if($showdateResult && $showdateResult->num_rows>0){
        echo '<option selected disabled>Select Date</option>';
        while($field=$showdateResult->fetch_assoc()){
            echo '<option value="'.$field['show_date'].'">'.$field['show_date'].'</option>';
        }
    }
    exit;
}

if (isset($_GET['theater_id']) && isset($_GET['movie_id']) && isset($_GET['show_date'])) {
    $theater_id = intval($_GET['theater_id']);
    $movie_id = intval($_GET['movie_id']);
    $show_date = $_GET['show_date'];

    $showtimeSQL = "SELECT showtime_id, show_time FROM showtime WHERE theater_id = $theater_id AND movie_id = $movie_id AND show_date = '$show_date'";
    $showtimeResult = $conn->query($showtimeSQL);

    if($showtimeResult && $showtimeResult->num_rows>0){
        echo '<option selected disabled>Select Time</option>';
        while ($row = $showtimeResult->fetch_assoc()) {
            echo '<option value="' . $row['showtime_id'] . '">' . $row['show_time'] . '</option>';
        }
    }else{
        echo '<option selected disabled>No Showtimes Available</option>';
    }
    exit;
}

?>