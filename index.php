<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css" />
    <!-- Bootstrap JS -->
    <script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="main.css" />
    <title>HOME PAGE</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <h3 class="text-warning">CARTECH</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php" style="color:#ffcb3d;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cars.php">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                <button class="btn btn-primary" style="margin-right:1%;"><a href="login.php" class="text-decoration-none" style="color:aliceblue;">Login</a></button>
                <button class="btn btn-success"><a href="register.php" class="text-decoration-none" style="color:aliceblue;">Register Here</a></button>
            </div>
        </div>
    </nav>
    <!-- NAV ENDING -->
    <div class="container" style="padding-top:5%;padding-left:10%;padding-right:10%;padding-bottom:3%;">
        <div class="card bg-dark">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Company:</option>
                            <option>Toyota</option>
                            <option>Suzuki</option>
                            <option>Hondai</option>
                            <option>Honda</option>
                            <option>Nishan</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Year:</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Category:</option>
                            <option>Petrol</option>
                            <option>Disel</option>
                            <option>CNG</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 text-center">
                        <a href="cars.php"><button class="btn btn-primary btn-lg btn-block" type="button">Search</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-bottom:10%;">
        <div class="card-group">
            <div class="card bg-dark">
                <a href="cars.php"><img src="https://www.cars24.com/js/2908cfd3d958c93b4f6151f3c163b240.svg" class="p-4" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">SADAN</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="cars.php"><img src="https://www.cars24.com/js/86ecb10799d0a2609ca7d41d35621c87.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">COUPE</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="cars.php"><img src="https://www.cars24.com/js/86ecb10799d0a2609ca7d41d35621c87.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">SUV</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="cars.php"><img src="https://www.cars24.com/js/7702ba8c69c84ba553d11584e3833c57.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">HATCHBACK</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="cars.php"><img src="https://www.cars24.com/js/62de9dd25631131c69a2dc8b9ed24df8.svg" class="p-4" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">CONVERTABLE</h4>
                        </div>
            </div>
        </div>
    </div>
    <?php
    include_once "footer.php";
    ?>
</body>

</html>