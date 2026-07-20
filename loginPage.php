<?php 

require_once "database_Connection.php";

if(isset($_POST['login'])){
    session_start();
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // declaration = value
    $_SESSION['username'] = $username;

    $loginsql = "Select * FROM user where (username = '".$username."' OR email='".$username."') AND password='".$password."' AND status = 'Active'";
    $result = $conn->query($loginsql);

    // conditional to check if there is a mtach record
    if ($result->num_rows == 1) {
        // fetch assoc magcoconvert into one array
        $field = $result->fetch_assoc();
        $UserType = $field['role'];
        //create conditional statement to redirect user based on the account type
        $fullname = $field['full_name'];
        $username = $field['username'];
        $userImage = $field['image_path'];
        $_SESSION['role'] = $UserType;
        $_SESSION['full_name'] = $fullname;
        $_SESSION['username'] = $username;
        $_SESSION['image_path'] = $userImage;
        $ID = $field['user_id'];
        $_SESSION['user_id'] = $ID;
        $logssql ="Insert into tbl_logs (user_id,action,datetime,role) values ('".$ID."','Logged In',NOW(),'".$UserType."')";
        $conn->query($logssql);

        //$_SESSION['fullname'] = $fname." ".$lname; 

        if ($UserType == "Admin") {
            header("location: adminPage_Dashboard.php");
        } elseif ($UserType == "Employee") {
            header("location: employeePage_Dashboard.php");
        } elseif ($UserType == "Customer") {
            header("location: index.php");
        }

    }else {
    ?>
    <script> Swal.fire({
        icon: "error",
        title: "Invalid Login",
        showConfirmButton: false,
        timer: 1500
    });
    </script>
    <?php
    }
}
// echo $conn->error
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .form-control::placeholder {
            color: grey !important;
            opacity: 1;
            }
        </style>
        <title>REELWAVE | Log In</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="bg-image" style="background-image: url('https://www.hannatalks.com/wp-content/uploads/2018/01/XPLUS-20171210-001.jpg'); background-size:1586px 1058px;">
        <header>
             <nav
                class="navbar navbar-expand-lg bg-dark"
                style="padding: 15px"
            >
                <div class="container-fluid">
                <a
                    class="navbar-brand d-flex align-items-center"
                    href="index.php"
                    style="font-size: 1.8rem; font-weight: bold"
                >
                    <!-- <img
                    src=""
                    alt="Logo"
                    style="height: 40px; margin-right: 10px"
                    /> -->
                    <span
                        class="text-light"
                        style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">
                        REELWAVE
                    </span>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                    style="border-color: #fff"
                >
                    <span class="navbar-toggler-icon" style="color: white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul
                    class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll"
                    style="
                        --bs-scroll-height: 400px;
                        font-size: 1.2rem;
                        font-weight: bold;
                        overflow: hidden;
                    "
                    >
                    <li class="nav-item">
                        <a
                        class="nav-link active text-light"
                        aria-current="page"
                        href="index.php"
                        style="padding: 10px 20px; text-align: center"
                        ><i class="bi bi-house-fill" style="margin-right: 6px"></i>
                        Home</a
                        >
                    </li>

                    <li class="nav-item">
                        <a
                        class="nav-link active text-light"
                        aria-current="page"
                        href="nowShowing.php"
                        style="padding: 10px 20px; text-align: center"
                        ><i class="bi bi-house-fill" style="margin-right: 6px"></i>
                        Now Showing</a
                        >
                    </li>

                    <li class="nav-item">
                        <a
                        class="nav-link text-light"
                        href="comingSoon.php"
                        style="padding: 10px 20px; text-align: center"
                        ><i class="bi bi-people-fill" style="margin-right: 10px"></i
                        >Coming Soon</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                        class="nav-link text-light"
                        href="theaters.php"
                        style="padding: 10px 20px; text-align: center"
                        ><i class="bi bi-phone-fill" style="margin-right: 6px"></i
                        >Theaters</a
                        >
                    </li>
                    <li class="nav-item d-lg-none d-flex justify-content-center">
                        <a
                        class="nav-link text-light d-flex align-items-center"
                        href="loginPage.php"
                        style="padding: 10px 20px; text-align: center"
                        >
                        <i class="bi bi-cart-fill" style="margin-right: 10px"></i>
                        <span
                            style="
                            font-size: 1.2rem;
                            font-weight: bold;
                            margin-right: 10px;
                            "
                            >Log In</span
                        >
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="ms-auto d-none d-lg-flex align-items-center">
                    <a class="nav-link text-light d-flex align-items-center"
                        href="join_us.php"
                        style="padding: 10px 10px; font-size: 1.5rem; text-align: center"
                    >
                        <span
                            style="font-size: 1.2rem; font-weight: bold; margin-right: 10px"
                            >Join Us</span
                        >
                    </a>
                    <a class="btn btn-white nav-link text-light d-flex align-items-center"
                        href="loginPage.php"
                        style="padding: 10px 10px; font-size: 1.5rem; text-align: center"
                    >
                        <span style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">Log In</span>
                    </a>
                </div>
                </div>
            </nav>
        </header>
    
   
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
  <div class="row justify-content-center w-100">  
    <div class="col-md-6 col-lg-4 bg-dark border border-dark rounded-4 p-5">
      <form action="loginPage.php" method="post">

    
        <div class="row text-center mt-3">
          <div class="col">
            <img src="assets\LOGO_RW.png" class="w-50" alt="">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col">
            <label for="username" class="form-label text-secondary">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
        </div>

        
        <div class="row mt-3">
          <div class="col">
            <label for="password" class="form-label text-secondary">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
        </div>

        
        <div class="row text-center mt-4">
          <div class="col">
            <input type="submit" name="login" class="btn btn-info btn-block w-75" value="Log In">
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
