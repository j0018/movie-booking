<?php
require_once "database_Connection.php";
session_start();

$isLoggedIn = isset($_SESSION['user_id']);

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
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="bg-image" style="background-image: url('https://www.hannatalks.com/wp-content/uploads/2018/01/XPLUS-20171210-001.jpg'); background-size:1586px 1058px; background-attachment: fixed;">
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
                        <?php if ($isLoggedIn){
                            ?>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, <?php echo $_SESSION['username']; ?>!
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                    <li><a class="dropdown-item text-light" href="">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-light" href="orderedTickets.php">Ordered Tickets</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-light" href="">Manage Account</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-light" href="">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-light" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <?php
                        }else{ 
                            ?>
                            <a class="nav-link text-light d-flex align-items-center"
                                href="signupCustomer.php"
                                style="padding: 10px 10px; font-size: 1.5rem; text-align: center">
                                <span style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">Sign Up</span>
                            </a>
                            <a class="btn btn-white nav-link text-light d-flex align-items-center"
                                href="login.php"
                                style="padding: 10px 10px; font-size: 1.5rem; text-align: center">
                                <span style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">Log In</span>
                            </a>
                            <?php 
                        } ?>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container bg-dark text-white p-5 w-75 rounded-3 my-5">
            <div class="row">
                <div class="col text-center">
                    <h1>Coming Soon</h1>
                </div>
            </div>
            <!-- now showing movies listed in 4 columns -->
            <?php
            require_once "database_Connection.php";

            $selectSQL = "Select * from movie Where release_date > NOW() Order by release_date DESC";

            $result = $conn->query($selectSQL);

            if($result->num_rows > 0){
                echo "<div class=row>";
                foreach($result as $index=>$field){
                ?>
                    <div class="col-3">
                        <div class="container p-3 text-white text-center">
                            <div class="row">
                                <div class="col pb-2">
                                    <a href="movieDetails2.php?id=<?php echo $field['movie_id']; ?>">
                                        <img src="<?php echo $field['movie_image']?>" alt="" class="img-fluid w-100 rounded-2">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="movieDetails2.php?id=<?php echo $field['movie_id']; ?>"
                                    class="text-light"
                                    style=" text-decoration: none;">
                                        <h4 class="text-center"><?php echo $field['title']?></h4>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><?php echo $field['genre']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><?php echo $field['release_date']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    if($index+1 % 4==0){
                        echo "<div></div class=row>";
                    }
                }
                echo "<div></div>";
            }
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>