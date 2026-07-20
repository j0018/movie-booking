<?php 
    session_start();
    $username = $_SESSION['username'];
    $fullname = $_SESSION['full_name'];
    $userImage = $_SESSION['image_path'];
    $UserType = $_SESSION['role'];
    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a Showtime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="external.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  </head>

  <body class="bg-image text-white" style="background-image: url('https://www.hannatalks.com/wp-content/uploads/2018/01/XPLUS-20171210-001.jpg'); background-size:1586px 1058px;">
<nav class="navbar navbar-dark px-3  ">
  <div class="row text-center">
    <div class="col-2 align-middle">
      <a class="navbar-brand navbar-text fw-bold" href="adminPage_Dashboard.php">REELWAVE</a>

    </div>
  </div>
  

  <div class="ms-auto">
    <span class="navbar-text fw-bold">
      <?php echo $UserType.' : '.$username;
      ?>
    </span>
    <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right">Logout</i></a>
  </div>
</nav>

    <div class="container-fluid full-height mx-2">
      <div class="row h-100">
      
        <div class="col-2 sidebar border border-danger rounded">
  <div class="mb-2 mt-2">
    <h4>
      <img src="<?php echo htmlspecialchars($userImage); ?>" alt="Profile Image" class="img-fluid rounded-circle w-50 mx-auto d-block">
    </h4>
</div>
<div class="mb-5 text-center">
    <h4>
      <?php echo $fullname;?> <br>
      <span class="fst-italic fw-light"><?php echo $UserType;?> </span>
    </h4>
</div>


          <table class="table table-hover table-dark border border-danger">
            <tr><td><a href="adminPage_Dashboard.php" class="text-white text-decoration-none"><h5><i class="bi bi-house"></i> Overview</h5></a></td></tr>
            <tr><td><a href="adminPage_Users.php" class="text-white text-decoration-none"><h5><i class="bi bi-people"></i> Users</h5></a></td></tr>
            <tr><td><a href="adminPage_Movies.php" class="text-white text-decoration-none"><h5> <i class="bi bi-film"></i> Movies</h5></a></td></tr>
            <tr><td><a href="adminPage_addTheater.php" class="text-white text-decoration-none"><h5><i class="bi bi-geo-alt"></i> Theater</h5></a></td></tr>
            <tr><td><a href="adminPage_Showtime.php" class="text-white text-decoration-none"><h5><i class="bi bi-camera-reels-fill"></i> Showtime</h5></a></td></tr>
            <tr><td><a href="adminPage_Logs.php" class="text-white text-decoration-none"><h5><i class="bi bi-activity"></i> Logs</h5></a></td></tr>
          </table>
          </table>
          
        </div>
    

        
        <div class="col-10  form-container">
            <div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>List of Showtimes</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addShowtimeModal">
      <i class="bi bi-plus-circle me-1"></i> Add Showtime
    </button>
  </div>
  
  <form action="adminPage_Showtime.php" method="post" class="mb-4 d-flex gap-2">
    <input type="search" name="search_Input" class="form-control" placeholder="Search...">
    <button name="btn_search" class="btn btn-info text-white">Search</button>
</form>

<!-- Showtime Table -->
<div class="card bg-dark border border-danger round p-4">
  <h4 class="text-white">Showtime List</h4>
  <table class="table table-dark table-hover mt-3 text-center">
    <thead>
      <tr>
        <th>Movie Poster</th>
        <th>Showtime ID</th>
        <th>Movie</th>
        <th>Theater</th>
        <th>Date</th>
        <th>Time</th>
        <th>Available Seats</th>
      </tr>
    </thead>
    <tbody>
      <?php
require_once "database_Connection.php";

// Set limit
$limit = 9;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$searchClause = "";
if (isset($_POST['btn_search'])) {
    $searchInput = $conn->real_escape_string($_POST['search_Input']);
    $searchClause = "WHERE m.title LIKE '%$searchInput%' OR t.theater_name LIKE '%$searchInput%' OR s.show_date LIKE '%$searchInput%'";
}

// Query with pagination
$selectsql = "
  SELECT s.showtime_id, m.title, m.movie_image, t.theater_name, s.show_date, s.show_time, s.available_seats
  FROM showtime s
  JOIN movie m ON s.movie_id = m.movie_id
  JOIN theater t ON s.theater_id = t.theater_id
  $searchClause
  ORDER BY s.show_date DESC, s.show_time DESC
  LIMIT $limit OFFSET $offset
";

// Count query for pagination
$countsql = "
  SELECT COUNT(*) as total
  FROM showtime s
  JOIN movie m ON s.movie_id = m.movie_id
  JOIN theater t ON s.theater_id = t.theater_id
  $searchClause
";

$result = $conn->query($selectsql);
$countResult = $conn->query($countsql);
$row = $countResult->fetch_assoc();
$totalShowtimes = $row['total'];
$totalPages = ceil($totalShowtimes / $limit);

// Display table rows
if ($result && $result->num_rows > 0) {
  while ($field = $result->fetch_assoc()) {
    $movie_image = $field['movie_image'];
    echo "
      <tr class='text-center'>
        <td><img src='" . htmlspecialchars($movie_image) . "' alt='Movie Poster' width='60' height='80'></td>
        <td>{$field['showtime_id']}</td>
        <td>{$field['title']}</td>
        <td>{$field['theater_name']}</td>
        <td>{$field['show_date']}</td>
        <td>{$field['show_time']}</td>
        <td>{$field['available_seats']}</td>
      </tr>
    ";
  }
} else {
  echo "<tr><td colspan='6' class='text-center'>No showtimes found.</td></tr>";
}
?>
    </tbody>
  </table>
  <!-- Pagination -->
<nav>
  <ul class="pagination justify-content-center mt-3">
    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
      echo "<li class='page-item " . ($i == $page ? "active" : "") . "'>
              <a class='page-link' href='?page=$i'>$i</a>
            </li>";
    }
    ?>
  </ul>
</nav>

</div>

<!-- Modal Form -->
<div class="modal fade" id="addShowtimeModal" tabindex="-1" aria-labelledby="addShowtimeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-white bg-dark">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addShowtimeModalLabel">Add New Showtime</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Movie</label>
            <select name="movie_id" class="form-control" required>
              <?php
                $movieList = $conn->query("SELECT movie_id, title FROM movie");
                while ($field = $movieList->fetch_assoc()) {
                  echo "<option value='{$field['movie_id']}'>{$field['movie_id']} - {$field['title']}</option>";
                }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Theater</label>
            <select name="theater_id" class="form-control" required>
              <?php
                $theaterList = $conn->query("SELECT theater_id, theater_name FROM theater");
                while ($field = $theaterList->fetch_assoc()) {
                  echo "<option value='{$field['theater_id']}'>{$field['theater_id']} - {$field['theater_name']}</option>";
                }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Show Date</label>
            <input type="date" name="show_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Show Time</label>
            <div class="d-flex gap-2">
              <input name="sh" type="number" min="0" max="23" class="form-control" placeholder="HH" required>
              <input name="sm" type="number" min="0" max="59" class="form-control" placeholder="MM" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Available Seats</label>
            <input name="avail_seats" type="number" class="form-control" placeholder="e.g., 100" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="adds" class="btn btn-success">Add Showtime</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

            
          </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>



<?php 
require_once "database_Connection.php";

if(isset($_POST['adds'])){
$movie_id = $_POST['movie_id'];
$theater_id = $_POST['theater_id'];
$show_date = $_POST['show_date'];
$sh = $_POST['sh'];
$sm = $_POST['sm'];
$show_time = $sh.' : '.$sm;
$available = $_POST['avail_seats'];

// for logs 
    $ID= $field['user_id'];
    $_SESSION['user_id'] = $ID;
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Added New Showtime',NOW(),'".$UserType."')";
    $conn->query($logssql);


$insertsql = "Insert into showtime (movie_id, theater_id, show_date, show_time, available_seats) values ($movie_id, $theater_id, '$show_date', '$show_time', $available)";
$result = $conn->query($insertsql);


// echo $conn->error;

if ($result == TRUE) {
    ?>
<script> Swal.fire({
    icon: "success",
    title: "New Showtime!",
    showConfirmButton: false,
    timer: 1500
  });
</script>
    <?php 
} else {
    echo $conn->error;
    
}



}





?>
