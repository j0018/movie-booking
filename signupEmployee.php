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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>REELWAVE | Registration</title>
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
                        href="login.php"
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
                        href="login.php"
                        style="padding: 10px 10px; font-size: 1.5rem; text-align: center"
                    >
                        <span style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">Log In</span>
                    </a>
                </div>
                </div>
            </nav>
        </header>
        <div class="container bg-dark text-white p-5 w-50 rounded-4 my-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row pb-4">
                    <div class="col">
                        <h1 class="h1 text-center">Registration</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col pb-3">
                        <img alt="" id="preview_img" width=200 height=200  class="img-thumbnail mx-auto d-block">
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <input type="file" name="upload_img" id="upload_img_btn" class="form-control w-25 mx-auto d-block" onchange="previewImage(event)" required>
                    </div>
                </div>
                <div class="row pb-3 w-75 mx-auto">
                    <div class="col">
                        <input type="text" class="form-control border-1 border-secondary bg-dark text-white" name="first" id="" placeholder="First Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control border-1 border-secondary bg-dark text-white" name="last" id="" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="row pb-3 w-75 mx-auto">
                    <div class="col">
                        <input type="email" class="form-control border-1 border-secondary bg-dark text-white" name="email" id="" placeholder="Email" required>
                    </div>
                </div>
                <div class="row pb-3 w-75 mx-auto">
                    <div class="col">
                        <input type="text" class="form-control border-1 border-secondary bg-dark text-white" name="username" id="" placeholder="Username" required>
                    </div>
                </div>
                <div class="row pb-3 w-75 mx-auto">
                    <div class="col">
                        <input type="password" class="form-control border-1 border-secondary bg-dark text-white" name="password" id="" placeholder="Password" required>
                    </div>
                </div>
                <div class="row pb-3 w-75 mx-auto">
                    <div class="col">
                        <select name="role" class="form-control border-1 border-secondary bg-dark text-white" id="" required>
                            <option selected disabled>Select Role</option>
                            <option>Admin</option>
                            <option>Employee</option>
                        </select>    
                    </div>
                </div>
                <div class="row w-75 mx-auto text-center">
                    <div class="col">
                        <input type="submit" value="Register" name="sub" class="form-control p-2 w-25 mx-auto btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function previewImage(event) {
                var display_img = document.getElementById("preview_img");
                console.log(display_img);
                display_img.src = URL.createObjectURL(event.target.files[0]);        
            }
        </script>
    </body>
</html>

<?php 

require_once "database_Connection.php";
include "email_verify.php";

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
        send_verification($fullname,$email,$OTP);
        ?>
        <script> 
            Swal.fire({
                icon: "success",
                title: "Account Created!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "verifyotp.php";
            });
        </script>
        <?php 
    } else {
        echo $conn->error;
    }
}

?>
