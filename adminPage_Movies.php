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
    <title>Movies</title>
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
    
    
        <!-- end ng column 1 -->
        

        <div class="col">
            

        <div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>List of Movies</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMovieModal">
      <i class="bi bi-plus-circle me-1"></i> Add Movie
    </button>
  </div>
  
  <form action="adminPage_Movies.php" method="post" class="mb-4 d-flex gap-2">
    <input type="search" name="search_Input" class="form-control" placeholder="Search...">
    <button name="btn_search" class="btn btn-info text-white">Search</button>
</form>


          <?php 
// kailangan iopen lagi database connection

// start ng dbase from a different php file
require_once "database_Connection.php";


// magset ng limit kung ilan ididisplay
$limit = 9;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

if (isset($_POST['btn_search'])) {
    //user_input
    $searchinput = $_POST['search_Input'];
    $selectsql = "Select * from movie where title like '%".$searchinput."%' 
    OR genre like '%".$searchinput."%'
    "; 
    $countsql = "SELECT COUNT(*) as total FROM movie 
                  WHERE title LIKE '%$searchinput%' 
                  OR movie_id LIKE '%$searchinput%' 
                  OR genre LIKE '%$searchinput%'";

} else {
    
    $selectsql = "Select * from movie LIMIT $limit OFFSET $offset"; 
    $countsql = "SELECT COUNT(*) as total FROM movie";
}

$result = $conn->query($selectsql); 
$countResult = $conn->query($countsql);
$row = $countResult->fetch_assoc();
$totalMovies = $row['total'];
$totalPages = ceil($totalMovies / $limit);
$result = $conn->query($selectsql); 
// convert query string to a SQL statement and return a 2d array of records

//check table if empty 
if ($result->num_rows > 0) {
    echo '<div class="container">';
    echo '<div class="row justify-content-center">';

    foreach ($result as $index => $field) {
        $modalID = "viewMoviesModal_" . $index;
        $deleteModalID = "deleteModal_" . $index;
        $updateModalID = "updateModal_" . $index;
?>
        <div class="col-md-3 m-3 bg-dark border border-danger rounded p-3 text-center text-white">
            <img src="<?php echo htmlspecialchars($field['movie_image']); ?>" width="200" height="300" alt="" class="img-fluid">
            <h5 class="mt-2"><?php echo htmlspecialchars($field['title']); ?></h5>
            <p><?php echo htmlspecialchars($field['genre']); ?></p>
            <p><?php echo htmlspecialchars($field['release_date']); ?></p>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">View Details</button>
        </div>

        <!-- Movie Details Modal -->
        <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" aria-labelledby="<?php echo $modalID; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?php echo $modalID; ?>Label"><?php echo htmlspecialchars($field['title']); ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo htmlspecialchars($field['description']); ?></p>
                        <div class="text-end">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#<?php echo $updateModalID; ?>">Edit</button>
                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#<?php echo $deleteModalID; ?>">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="<?php echo $deleteModalID; ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the movie <strong><?php echo htmlspecialchars($field['title']); ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="delete.php" method="post">
                            <input type="hidden" name="record_id" value="<?php echo $field['movie_id']; ?>">
                            <input type="hidden" name="record_type" value="movie">
                            <input type="hidden" name="redirect" value="adminPage_Movies.php">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


       <!-- Update Movie Modal -->
<div class="modal fade" id="<?php echo $updateModalID; ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title">Edit Movie Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="type" value="movie">
                    <input type="hidden" name="movie_id" value="<?php echo $field['movie_id']; ?>">
                    <input type="hidden" name="redirect2" value="adminPage_Movies.php">
                    
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo htmlspecialchars($field['movie_image']); ?>" id="update_preview_img" width="200" height="300" class="img-thumbnail mb-3">
                            <input type="file" name="update_movie_img" class="form-control w-75 mx-auto" onchange="updatePreviewImage(event)">
                        </div>
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($field['title']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($field['genre']); ?>" required>
                            </div>
                            
                            <?php 
                           
                            $durationParts = explode(':', $field['duration']);
                            $h = $durationParts[0] ?? 0;
                            $m = $durationParts[1] ?? 0;
                            $s = $durationParts[2] ?? 0;
                            ?>
                            
                            <div class="mb-3">
                                <label class="form-label">Duration</label><br>
                                <input name="h" type="number" min="0" max="23" class="me-1" style="width: 60px;" value="<?php echo $h; ?>"> <label>h</label>
                                <input name="m" type="number" min="0" max="59" class="ms-3 me-1" style="width: 60px;" value="<?php echo $m; ?>"> <label>m</label>
                                <input name="s" type="number" min="0" max="59" class="ms-3 me-1" style="width: 60px;" value="<?php echo $s; ?>"> <label>s</label>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Release Date</label>
                                <input type="date" class="form-control" name="release_date" value="<?php echo htmlspecialchars($field['release_date']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4" required><?php echo htmlspecialchars($field['description']); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_update" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updatePreviewImage(event) {
    const display_img = document.getElementById("update_preview_img");
    display_img.src = URL.createObjectURL(event.target.files[0]);
}
</script>
<?php
        
        if (($index + 1) % 3 == 0) {
            echo '</div><div class="row justify-content-center">';
        }
    }

    echo '</div>'; // final row
    echo '</div>'; // container

  
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination justify-content-center mt-3">';

for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='adminPage_Movies.php?page=$i'>$i</a></li>";
}

echo '</ul>';
echo '</nav>';
} else {
    echo "<p class='text-center'>No record found</p>";
}
?>

</div>
</body>
</html>

    </div>
  
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  
  <div class="modal fade" id="addMovieModal" tabindex="-1" aria-labelledby="addMovieModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="addMovieModalLabel">Add New Movie</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="adminPage_Movies.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-4 text-center">
              <img alt="" id="preview_img" width="300" height="450" class="img-thumbnail mb-3">
              <input type="file" name="upload_movie_img" class="form-control w-75 mx-auto" onchange="previewImage(event)">
            </div>

            <div class="col-md-8">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control">
              </div>

              <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" id="genre" name="genre" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Duration</label><br>
                <input id="h" name="h" type="number" min="0" max="23" class="me-1" style="width: 60px;"> <label for="h">h</label>
                <input id="m" name="m" type="number" min="0" max="59" class="ms-3 me-1" style="width: 60px;"> <label for="m">m</label>
                <input id="s" name="s" type="number" min="0" max="59" class="ms-3 me-1" style="width: 60px;"> <label for="s">s</label>
              </div>

              <div class="mb-3">
                <label for="date" class="form-label">Release Date</label>
                <input type="date" id="date" name="date" class="form-control">
              </div>

              <div class="mb-3">
                <label for="form6Example7" class="form-label">Description</label>
                <textarea class="form-control" name="movie_desc" id="form6Example7" rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <button type="submit" name="addm" class="btn btn-primary w-50">
              <i class="bi bi-plus-circle me-2"></i> Add Movie
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
  <script>
  function previewImage(event) {
    const display_img = document.getElementById("preview_img");
    display_img.src = URL.createObjectURL(event.target.files[0]);
  }
</script>
  
  </body>
</html>
<?php 

if(isset($_POST['addm'])){
$title = $_POST['title'];
$genre = $_POST['genre'];
$h = $_POST['h'];
$m = $_POST['m'];
$s = $_POST['s'];
$duration = $h.":".$m.":".$s;
$release_date = $_POST['date'];
$description = $_POST['movie_desc'];
$movieImagePath = "movie_images/".basename($_FILES['upload_movie_img']['name']);
move_uploaded_file($_FILES['upload_movie_img']['tmp_name'], $movieImagePath);

// for logs 
    $ID = $_SESSION['user_id'];
    $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Added a Movie',NOW(),'".$UserType."')";
    $conn->query($logssql);


$insertsql = "Insert into movie (title, genre, duration, release_date, description, movie_image) values ('$title', '$genre', '$duration', '$release_date', '$description', '$movieImagePath')";
$result = $conn->query($insertsql);


// echo $conn->error;

if ($result == TRUE) {
    ?>
<script> Swal.fire({
    icon: "success",
    title: "Movie Added!",
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

