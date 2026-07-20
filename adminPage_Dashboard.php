<?php
include 'database_Connection.php'; 

 session_start();
    $username = $_SESSION['username'];
    $fullname = $_SESSION['full_name'];
    $userImage = $_SESSION['image_path'];
    $UserType = $_SESSION['role'];


$user_result = $conn->query("SELECT COUNT(*) as count FROM user");
$user_count = $user_result->fetch_assoc()['count'];


$movie_result = $conn->query("SELECT COUNT(*) as count FROM movie");
$movie_count = $movie_result->fetch_assoc()['count'];


$theater_result = $conn->query("SELECT COUNT(*) as count FROM theater");
$theater_count = $theater_result->fetch_assoc()['count'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
   <link rel="stylesheet" href="external.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  </head>

  <body class="bg-image text-white" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://www.hannatalks.com/wp-content/uploads/2018/01/XPLUS-20171210-001.jpg'); background-size:1586px 1058px;;">
<nav class="navbar navbar-dark px-3 border-secondary rounded ">
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
    
        <!-- end ng column 1 -->

        <div class="col">
            
        <div class="row mt-2">
          <div class="col">
            <h1>Movie Booking Dashboard</h1>
          </div>
        </div>
        
  
    <div class="container mt-3">

    
    
  <div class="row text-center">
    <div class="col border border-danger rounded mx-5">
      <div class="row p-5 bg-dark text-white position-relative">
        <div class="col-6 d-flex align-items-center justify-content-center">
          <h1 class="mb-0 display-1"><?php echo $user_count; ?></h1>
        </div>
        <div class="col-6 d-flex flex-column align-items-center justify-content-center">
          <i class="bi bi-person-circle fs-1"></i> 
          <h5 class="mt-2">Users</h5>
        </div>
        <a href="adminPage_Users.php" class="stretched-link"></a>
      </div>
    </div>

    <div class="col border border-danger rounded mx-5">
      <div class="row p-5 bg-dark text-white position-relative">
        <div class="col-6 d-flex align-items-center justify-content-center">
          <h1 class="mb-0 display-1"><?php echo $movie_count; ?></h1>
        </div>
        <div class="col-6 d-flex flex-column align-items-center justify-content-center">
          <i class="bi bi-film fs-1"></i> 
          <h5 class="mt-2">Movies</h5>
        </div>
        <a href="adminPage_Movies.php" class="stretched-link"></a>
      </div>
    </div>

    <div class="col border border-danger rounded mx-5">
      <div class="row p-5 bg-dark text-white position-relative">
        <div class="col-6 d-flex align-items-center justify-content-center">
          <h1 class="mb-0 display-1"><?php echo $theater_count; ?></h1>
        </div>
        <div class="col-6 d-flex flex-column align-items-center justify-content-center">
          <i class="bi bi-geo-alt fs-1"></i>
          <h5 class="mt-2">Theaters</h5>
        </div>
        <a href="adminPage_addTheater.php" class="stretched-link "></a>
      </div>
    </div>

       
 
      </div>
    </div>
    

  
<hr class="bg-secondary ">
  <div class="container mt-5">
    <h1>Now Showing</h1>
</div>


    </div>
    </div>
  



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>

