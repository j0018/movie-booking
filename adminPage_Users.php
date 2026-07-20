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
            
        

 
  <div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Users</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
      <i class="bi bi-plus-circle me-1"></i> Add User
    </button>
  </div>


<form action="adminPage_Users.php" method="post" class="mb-4 d-flex gap-2">
    <input type="search" name="searchInput" class="form-control" placeholder="Search...">
    <button name="btnsearch" class="btn btn-info text-white">Search</button>
  </form>



          <?php 
// kailangan iopen lagi database connection

// start ng dbase from a different php file
require_once "database_Connection.php";
        // ---- > debug step to check if it's successful
// if (!$conn->connect_error) {
//     echo "Connection Successful";
// }


//display query 

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

if (isset($_POST['btnsearch'])) {
    //user_input
    $searchinput = $_POST['searchInput'];
    $selectsql = "Select * from user where full_name like '%".$searchinput."%' 
    OR user_id like '%".$searchinput."%'
    OR username like '%".$searchinput."%'
    OR role like '%".$searchinput."%'
    ";
      $countsql = "SELECT COUNT(*) as total FROM user 
                  WHERE role LIKE '%$searchinput%' 
                  OR user_id LIKE '%$searchinput%' 
          ";// string pa lang

} else {
    // if the search do not have any arguments 
    $selectsql = "Select * from user";
    $countsql = "SELECT COUNT(*) as total FROM user"; 
}
$result = $conn->query($selectsql); 
$countResult = $conn->query($countsql);
$row = $countResult->fetch_assoc();
$totalUsers = $row['total'];
$totalPages = ceil($totalUsers / $limit);
$result = $conn->query($selectsql); 
// convert query string to a SQL statement and return a 2d array of records

//check table if empty 

?>

<div class="container mt-4">
  <div class="row">
    <?php
    if ($result->num_rows > 0) {
        foreach ($result as $field) {
            echo '
            <div class="col-12 mb-3 text">
              <div class="card shadow bg-dark border-danger h-100 text-white">
                <div class="row g-1">
                  <div class="col-4 d-flex align-items-center justify-content-center p-2">
                    <img src="'.$field['image_path'].'" class="img-fluid rounded-circle" alt="User Image" style="width: 200px; height: 200px; object-fit: cover;">
                  </div>
                  <div class="col-8">
                    <div class="card-body">
                      <strong><h3 class="card-title mb-1">'.$field['full_name'].'</h3></strong>
                      <p class="card-text mb-1"><strong>User ID:</strong> '.$field['user_id'].'</p>
                      <p class="card-text mb-1"><strong>Email:</strong> '.$field['email'].'</p>
                      <p class="card-text mb-1"><strong>Role:</strong> '.$field['role'].'</p>
                      <p class="card-text"><strong>Username:</strong> '.$field['username'].'</p>
                      <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal'.$field['user_id'].'">Edit</button>
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal'.$field['user_id'].'">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- DELETE MODAL -->
            <div class="modal fade" id="deleteModal'.$field['user_id'].'" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content text-dark">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete user <strong>'.$field['full_name'].'</strong>?
                  </div>
                  <div class="modal-footer">
                    <form action="delete.php" method="post">
                      <input type="hidden" name="record_id" value="'.$field['user_id'].'">
                      <input type="hidden" name="record_type" value="user">
                      <input type="hidden" name="redirect" value="adminPage_Users.php">
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- UPDATE MODAL -->
            <div class="modal fade" id="updateModal'.$field['user_id'].'" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content text-dark">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="update.php" method="post">
                    <div class="modal-body">
                    <input type="hidden" name="type" value="user">
                      <input type="hidden" name="user_id" value="'.$field['user_id'].'">
                      <input type="hidden" name="redirect2" value="adminPage_Users.php">
                      <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="'.$field['full_name'].'" required>
                      </div>
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="'.$field['email'].'" required>
                      </div>
                      <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control">
                          <option value="Admin" '.($field['role']=='Admin'?'selected':'').'>Admin</option>
                          <option value="Employee" '.($field['role']=='Employee'?'selected':'').'>Employee</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
            ';
        }
   echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination justify-content-center mt-3">';

for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='adminPage_Users.php?page=$i'>$i</a></li>";
}

echo '</ul>';
echo '</nav>';
      } else {
        echo '<p class="text-muted">No users found.</p>';
    }
    ?>
  </div>
</div>

</div>
</body>
</html>

    </div>
    </div>
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="registerUserModalLabel">Add New User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="adminPage_Users.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-4 text-center">
              <img alt="User Image" id="preview_img" width="200" height="200" class="img-thumbnail mb-3 mx-auto d-block">
              <input type="file" name="upload_img" class="form-control w-75 mx-auto" onchange="previewImage(event)">
            </div>
            <div class="col-md-8">
              <div class="row mb-3">
                <div class="col">
                  <label for="firstname" class="form-label">First Name</label>
                  <input type="text" id="firstname" name="first" class="form-control">
                </div>
                <div class="col">
                  <label for="lastname" class="form-label">Last Name</label>
                  <input type="text" id="lastname" name="last" class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
              </div>

              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                  <option>Admin</option>
                  <option>Employee</option>
                </select>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <input type="submit" name="sub" class="btn btn-secondary w-50" value="Register">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php 

require_once "database_Connection.php";
// include "email_verify.php";

// not yet done; confused if maglalagay ba ako username sa table for log ins. 
if(isset($_POST['sub'])){
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$role = $_POST['role'];
$fullname = $first." ".$last;
$ImagePath = "user_images/".basename($_FILES['upload_img']['name']);
move_uploaded_file($_FILES['upload_img']['tmp_name'], $ImagePath);
$OTP =rand(000000,999999);
$status = "Pending";


$insertsql = "Insert into user (full_name, role, password, email, username, image_path, OTP, status ) values ('$fullname', '$role', '$password', '$email', '$username', '$ImagePath',$OTP,'$status')";
$result = $conn->query($insertsql);


// echo $conn->error;

if ($result == TRUE) {
   // send_verification($fullname,$email,$OTP);
    ?>
<script> Swal.fire({
    icon: "success",
    title: "Account created!",
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
