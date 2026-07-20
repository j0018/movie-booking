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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
    
        

        <div class="col">
            
        <h1 class= "text-center">LOGS</h1>

          <div class="container p-5 bg-dark">
            <!-- mag add ng search option-->
        <form action="adminPage_Logs.php" method="post">
          <div class="row g-5">
            <div class="col-auto">
            <input type="search" name="searchInput" id="" placeholder="Search" class="form-control">
            </div>
            <div class="col-auto">
            <input type="submit" name="btnsearch" value="Search" class="btn-info btn">
            </div>
        </div>
    </form>


          <?php 

require_once "database_Connection.php";

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

if (isset($_POST['btnsearch'])) {
    //user_input
    $searchinput = $_POST['searchInput'];
    $selectsql = "Select * from tbl_logs where role like '%".$searchinput."%' 
    OR user_id like '%".$searchinput."%'
    OR action like '%".$searchinput."%'
    OR datetime like '%".$searchinput."%'
    ORDER BY log_id DESC"; 
     $countsql = "SELECT COUNT(*) as total FROM tbl_logs 
                  WHERE role LIKE '%$searchinput%' 
                  OR user_id LIKE '%$searchinput%' 
                  OR action LIKE '%$searchinput%'
                  OR datetime like '%".$searchinput."%'";

} else {
    // if the search do not have any arguments 
    $selectsql = "Select * from tbl_logs ORDER BY log_id DESC LIMIT $limit OFFSET $offset"; 
    $countsql = "SELECT COUNT(*) as total FROM tbl_logs";
}

$countResult = $conn->query($countsql);
$row = $countResult->fetch_assoc();
$totalLogs = $row['total'];
$totalPages = ceil($totalLogs / $limit);
$result = $conn->query($selectsql); 
// convert query string to a SQL statement and return a 2d array of records

//check table if empty 

?>

<table class="mt-3 table table-hover table-bordered table-secondary">
<tr>
<th>Log ID</th>
<th>Role</th>
<th>User ID</th>
<th>Action</th>
<th>Date and Time</th>


</tr>

<?php
if ($result->num_rows > 0 ) {
// para magloop siya per record; we can customize depending on what we want to show/display
foreach ($result as $field) {
    echo"<tr>";
    echo"<td>".$field['log_id']."</td>";
    echo"<td>".$field['role']."</td>";
    echo"<td>".$field['user_id']."</td>";
    echo"<td>".$field['action']."</td>";
    echo"<td>".$field['datetime']."</td>";
    
   ;
    echo"</tr>";

}

?>
</table>
<?php 
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination justify-content-center mt-3">';

for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='adminPage_Logs.php?page=$i'>$i</a></li>";
}

echo '</ul>';
echo '</nav>';

 } else {
    echo "No record found"; // if empty table
}
?>

</div>
</body>
</html>


    </div>
    
    


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
