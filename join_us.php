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
                        href="loginPage.php"
                        style="padding: 10px 10px; font-size: 1.5rem; text-align: center"
                    >
                        <span style="font-size: 1.2rem; font-weight: bold; margin-right: 10px">Log In</span>
                    </a>
                </div>
                </div>
            </nav>
        </header>
      <div class="container bg-dark text-white p-5 w-75 rounded-3 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-4">Join REELWAVE</h1>
            <p class="lead mb-5">Select your account type to get started</p>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card bg-secondary text-white h-100">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title mb-4">Movie Lover</h3>
                            <i class="bi bi-person-hearts mb-4" style="font-size: 3rem;"></i>
                            <p class="card-text mb-4">Sign up as a customer to book tickets, get recommendations, and enjoy exclusive offers.</p>
                            <a href="signupCustomer.php" class="btn btn-light mt-auto">Sign Up as Customer</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card bg-secondary text-white h-100">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title mb-4">Cinema Professional</h3>
                            <i class="bi bi-briefcase-fill mb-4" style="font-size: 3rem;"></i>
                            <p class="card-text mb-4">Employee registration requires verification. Please have your employee ID ready.</p>
                            <a href="signupEmployee.php" class="btn btn-light mt-auto">Sign Up as Employee</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <p>Already have an account? <a href="loginPage.php" class="text-warning">Log In</a></p>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>