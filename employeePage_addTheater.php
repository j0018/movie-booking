 <?php 
 
require_once "database_Connection.php";
    session_start();
    $username = $_SESSION['username'];
    $fullname = $_SESSION['full_name'];
    $userImage = $_SESSION['image_path'];
    $UserType = $_SESSION['role'];

$limit = 9;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$searchInput = '';
$whereClause = '';
if (isset($_POST['btnsearch'])) {
    $searchInput = $conn->real_escape_string($_POST['searchInput']);
    $whereClause = "WHERE theater_name LIKE '%$searchInput%' OR location LIKE '%$searchInput%'";
}

$countSql = "SELECT COUNT(*) AS total FROM theater $whereClause";
$totalTheaters = $conn->query($countSql)->fetch_assoc()['total'];
$totalPages = ceil($totalTheaters / $limit);

$selectSql = "SELECT * FROM theater $whereClause LIMIT $limit OFFSET $offset";
$result = $conn->query($selectSql);
    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="external.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </head>

   <body class="bg-image text-white" style="background-image: url('https://www.hannatalks.com/wp-content/uploads/2018/01/XPLUS-20171210-001.jpg'); background-size:1586px 1058px;">
<nav class="navbar navbar-dark px-3  ">
  <div class="row text-center">
    <div class="col-2 align-middle">
      <a class="navbar-brand navbar-text fw-bold" href="employeePage_Dashboard.php">REELWAVE</a>

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
      
        <div class="col-2 sidebar border border-info rounded">
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


          <table class="table table-hover table-dark border border-info">
            <tr><td><a href="employeePage_Dashboard.php" class="text-white text-decoration-none"><h5><i class="bi bi-house"></i> Overview</h5></a></td></tr>
            <tr><td><a href="employeePage_Movies.php" class="text-white text-decoration-none"><h5> <i class="bi bi-film"></i> Movies</h5></a></td></tr>
            <tr><td><a href="employeePage_addTheater.php" class="text-white text-decoration-none"><h5><i class="bi bi-geo-alt"></i> Theater</h5></a></td></tr>
            <tr><td><a href="employeePage_Showtime.php" class="text-white text-decoration-none"><h5><i class="bi bi-camera-reels-fill"></i> Showtime</h5></a></td></tr>
          </table>
          </table>
          
        </div>
        
        <div class="col">
        
             <div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>List of Theaters</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTheaterModal">
      <i class="bi bi-plus-circle me-1"></i> Add Theater
    </button>
  </div>

  <form method="POST" class="mb-4 d-flex gap-2">
    <input type="search" name="searchInput" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($searchInput) ?>">
    <button name="btnsearch" class="btn btn-info text-white">Search</button>
  </form>

  <div class="row">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
          $id = $row['theater_id'];
          $name = htmlspecialchars($row['theater_name']);
          $location = htmlspecialchars($row['location']);
          $capacity = htmlspecialchars($row['capacity']);
        ?>
        <div class="col-md-4 mb-4">
          <div class="card bg-dark border-info text-white d-flex flex-column justify-content-between h-100">
            <div class="card-body">
              <h5 class="card-title"><?= $name ?></h5>
              <p class="card-text"><strong>Location:</strong> <?= $location ?></p>
              <p class="card-text"><strong>Capacity:</strong> <?= $capacity ?></p>
              <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal_<?= $id ?>">Edit</button>
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal_<?= $id ?>">Delete</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal_<?= $id ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
              <form action="update.php" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Theater</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="type" value="theater">
                  <input type="hidden" name="theater_id" value="<?= $id ?>">
                  <input type="hidden" name="redirect2" value="employeePage_addTheater.php">
                  <div class="mb-3">
                    <label class="form-label">Theater Name</label>
                    <input type="text" name="theater_name" class="form-control" value="<?= $name ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= $location ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-control" value="<?= $capacity ?>" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="btn_update" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal_<?= $id ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
              <form action="delete.php" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title">Confirm Delete</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                  Are you sure you want to delete <strong><?= $name ?></strong>?
                  <input type="hidden" name="record_id" value="<?= $id ?>">
                  <input type="hidden" name="record_type" value="theater">
                  <input type="hidden" name="redirect" value="employeePage_addTheater.php">
                </div>
                <div class="modal-footer">
                  <button type="submit" name="btn_delete" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col text-center">
        <h4>No theaters found.</h4>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
    <nav>
      <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTheaterModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <form method="POST" action="employeePage_addTheater.php">
        <div class="modal-header">
          <h5 class="modal-title">Add Theater</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Theater Name</label>
            <input type="text" name="theater" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="addt" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
// Add Theater Logic
if (isset($_POST['addt'])) {
  $theater = $conn->real_escape_string($_POST['theater']);
  $location = $conn->real_escape_string($_POST['location']);
  $capacity = (int)$_POST['capacity'];
  $userID = $_SESSION['user_id'];

  $insertSql = "INSERT INTO theater (theater_name, location, capacity) VALUES ('$theater', '$location', $capacity)";
  $logSql = "INSERT INTO tbl_logs (user_id, action, datetime, role) VALUES ('$userID', 'Added a Theater', NOW(), '$UserType')";

  if ($conn->query($insertSql)) {
    $conn->query($logSql);
    echo "<script>
      Swal.fire({icon: 'success', title: 'Theater added successfully', timer: 1500, showConfirmButton: false})
        .then(() => window.location.href='employeePage_addTheater.php');
    </script>";
  } else {
    echo "<script>Swal.fire({icon: 'error', title: 'Failed', text: '". $conn->error ."'})</script>";
  }
}
?>

</body>
</html>