<?php
    include_once "connection.php";
    ob_start();
    session_start();
    if(isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role']=="user")
    {
        // echo '<script type="text/javascript">alert("Welcome")</script>';
    
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="main.css" />
    <title>User View</title>
</head>

<body>
        <?php
            $q = "select * from user where email='".$_SESSION['em']."'";
            $result = mysqli_query($con, $q);
            $row = mysqli_fetch_array($result);
        ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <h3 class="text-warning">CARTECH</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user_view.php" style="color:#ffcb3d;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvcar.php">Buy Used Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sell.php">Sell Used Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvabout.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvcontact.php">Contact Us</a>
                    </li>
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-fluid rounded-circle" src="profile_pictures/<?php echo $row['profile'];?> " alt="Avatar Logo" style="width:40px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <p class="text-center mx-2"><?php echo $row['name'];echo "<br>";echo $row['email'];?><hr>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_profile" data-bs-whatever="@mdo">Edit Profile</button>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_profile_pic" data-bs-whatever="@mdo">Edit Profile Picture</button>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_pwd" data-bs-whatever="@mdo">Change Password</button>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV ENDING -->
    <!-- ------------------------------------------------------------------- -->

        <!-- edit profile -->
        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="edit_profileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_profileLabel">Edit Your Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" name="nm" class="form-control" value="<?php echo $row['name'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Email</label>
                                <input type="email" readonly name="em" class="form-control" value="<?php echo $row['email'];?>">
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                            <input type="submit" class="btn btn-secondary" name="btnep" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit profile picture-->
        <div class="modal fade" id="edit_profile_pic" tabindex="-1" aria-labelledby="edit_profile_picLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_profile_picLabel">Edit Your Profile Picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Select New Profile Picture</label>
                                <input type="file" name="new_ppic" class="form-control">
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                            <input type="submit" class="btn btn-secondary" name="btnepp" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- change password -->
        <div class="modal fade" id="change_pwd" tabindex="-1" aria-labelledby="change_pwdLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="change_pwdLabel">Change Your Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Old Password</label>
                                <input type="password" required name="opwd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">New Password</label>
                                <input type="password" required name="npwd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Confirm New Password</label>
                                <input type="password" required name="cnpwd" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                            <input type="submit" name="btncp" class="btn btn-secondary" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>


<!-- -------------------------------------------------------------------------------- -->
    <div class="container" style="padding-top:10%;padding-left:10%;padding-right:10%;padding-bottom:3%;">
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
                <a href="uvcar.php"><img src="https://www.cars24.com/js/2908cfd3d958c93b4f6151f3c163b240.svg" class="p-4" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">SADAN</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="uvcar.php"><img src="https://www.cars24.com/js/86ecb10799d0a2609ca7d41d35621c87.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">COUPE</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="uvcar.php"><img src="https://www.cars24.com/js/86ecb10799d0a2609ca7d41d35621c87.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">SUV</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="uvcar.php"><img src="https://www.cars24.com/js/7702ba8c69c84ba553d11584e3833c57.svg" class="p-4 pb-2" alt="cars" style="width:100%;height:100%;" /><a>
                        <div class="card-body">
                            <h4 class="text-center" style="color:#fff;">HATCHBACK</h4>
                        </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card bg-dark">
                <a href="uvcar.php"><img src="https://www.cars24.com/js/62de9dd25631131c69a2dc8b9ed24df8.svg" class="p-4" alt="cars" style="width:100%;height:100%;" /><a>
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

<?php
    }
    else
    {
        header("location:login.php");
    }
?>