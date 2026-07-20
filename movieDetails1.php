<?php
require_once "database_Connection.php";
session_start();

$isLoggedIn = isset($_SESSION['user_id']);

if (isset($_GET['id'])) {
    $movie_id = intval($_GET['id']);
    $moviePageSQL = "Select * from movie where movie_id = $movie_id";

    $result = $conn->query($moviePageSQL);

    if ($result->num_rows > 0) {
        $field = $result->fetch_assoc();
    } else {
        echo "Movie not found.";
        exit;
    }
} else {
    die("Invalid movie ID.");
    exit;
}

include "movieDetails1_dropdownDynamics.php";

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .input-group {
                flex-direction: row;
                max-width: 360px;
            }
            button, input {
                outline: none;
                border: none;
                padding: 9px;
                font-size: 18px;
            }
            #seats{
                width: 15%;
                text-align: center;
            }
            button {
                cursor: pointer;
            }
            button:nth-last-child(1) {
                border-bottom-right-radius: 7px;
                border-top-right-radius: 7px;
            }
            button:nth-child(1) {
                border-bottom-left-radius: 7px;
                border-top-left-radius: 7px;
            }
            button:hover {
                background-color: #e6e6e6;
            }
            button:nth-last-child(1):active {
            box-shadow: inset -4px 5px 10px rgba(0, 0, 0, 0.5);
            }
            button:nth-child(1):active {
            box-shadow: inset 4px 5px 10px rgba(0, 0, 0, 0.5);
            }
        </style>
        <title><?php echo $field['title']?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <div class="col">
                    <img src="<?php echo $field['movie_image']?>" alt="" class="img-fluid w-100 rounded-2">
                </div>
                <div class="col">
                    <h1><?php echo $field['title'];?></h1>
                    <div class="row">
                        <div class="col">
                            <p><b>Genre: </b><?php echo $field['genre'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><b>Release Date: </b><?php echo $field['release_date'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><b>Duration: </b><?php echo $field['duration'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><b>Synopsis: </b><?php echo $field['description'];?></p>
                        </div>
                    </div>
                    <!-- form for picking theater, showtime, number of seats -->
                     <form action="bookseatsForm.php" method="post">
                        <input type="hidden" name="movie_id" value="<?php echo $field['movie_id']; ?>">
                        <div class="row py-2">
                            <div class="row">
                                <label for="" class="form-label mb-1">Theater Location</label>
                                <select name="theater" id="theater" class="form-control mx-2" onchange="getDate(this.value)">
                                    <option selected disabled>Select Location</option>
                                    <?php
                                    $theaterSQL = "Select distinct t.theater_id, t.location from theater t join showtime s on s.theater_id = t.theater_id WHERE s.movie_id = $movie_id";

                                    $theaterResult = $conn->query($theaterSQL);

                                    if($theaterResult->num_rows > 0){
                                        while($field = $theaterResult->fetch_assoc()){
                                            echo '<option value="'.$field['theater_id'].'">'.$field['location'].'
                                            </option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-2">
                            <div class="row">
                                <label for="" class="form-label mb-1">Show Date</label>
                                <select name="showdate" id="showdate" class="form-control mx-2" onchange="getTime(this.value)">
                                    <option selected disabled>Select Date</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-2">
                            <div class="row">
                                <label for="" class="form-label mb-1">Show Time</label>
                                <select name="showtime" id="showtime" class="form-control mx-2">
                                    <option selected disabled>Select Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col">
                                <label for="" class="form-label mb-1">Number of Seats</label>
                                <div class="input-group">
                                    <button id="decrement" type="button">-</button>
                                    <input type="number" name="seats" id="seats" value="0" readonly>
                                    <button id="increment" type="button">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                if(isset($_SESSION['user_id'])){
                                    echo '<input type="submit" name="book" value="Book Tickets" class="btn btn-primary">';
                                }else{
                                    echo '<a href="login.php" class="btn btn-primary">Login to Book</a>';
                                }
                                ?>
                                <!-- <input type="submit" name="book" value="Book Tickets" class="btn btn-primary"> -->
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let counter = 0;
 
            function increment() {
                counter++;
            }
            
            function decrement() {
                counter--;
            }
            
            function get() {
                return counter;
            }
            
            const inc = document.getElementById("increment");
            const input = document.getElementById("seats");
            const dec = document.getElementById("decrement");
            
            inc.addEventListener("click", () => {
                if(input.value <= 7){
                    increment();
                }
                input.value = get();
            });
            
            dec.addEventListener("click", () => {
                if (input.value > 0) {
                    decrement();
                }
                input.value = get();
            });

            const movie_id = <?php echo $movie_id; ?>;

            function getDate(theater_id) {
                console.log("Theater ID:", theater_id);           // Debug
                console.log("Movie ID:", movie_id);

                const dateSelect = document.getElementById('showdate');
                const timeSelect = document.getElementById('showtime');
                console.log(`Fetching: movieDetails1_dropdownDynamics.php?theater_id=${theater_id}&movie_id=${movie_id}`);

                fetch(`movieDetails1_dropdownDynamics.php?theater_id=${theater_id}&movie_id=${movie_id}`)
                    .then(res => res.text())
                    .then(html => {
                        dateSelect.innerHTML = html;
                        timeSelect.innerHTML = '<option selected disabled>Select Time</option>';
                    })
                    .catch(err => {
                        console.error('Error fetching dates:', err);
                        dateSelect.innerHTML = '<option disabled>Error loading dates</option>';
                    });
            }

            function getTime(dateValue) {
                const theater_id = document.getElementById('theater').value;
                const timeSelect = document.getElementById('showtime');

                fetch(`movieDetails1_dropdownDynamics.php?theater_id=${theater_id}&movie_id=${movie_id}&show_date=${dateValue}`)
                    .then(res => res.text())
                    .then(html => {
                        timeSelect.innerHTML = html;
                    })
                    .catch(err => {
                        console.error('Error fetching times:', err);
                        timeSelect.innerHTML = '<option disabled>Error loading times</option>';
                    });
            }
        </script>
    </body>
</html>
<?php
if(isset($_POST['book'])){
    $logSQL = "Insert into tbl_logs (user_id, action, datetime, role) VALUES ('$isLoggedIn','Booked')";
}
?>