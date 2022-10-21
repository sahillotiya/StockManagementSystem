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
    <link rel="stylesheet" href="aboutus.css"/>
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
                        <a class="nav-link" aria-current="page" href="user_view.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvcar.php">Buy Used Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sell.php">Sell Used Car</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" style="color:#ffcb3d;" href="uvabout.php">About Us</a>
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
    <div class="container-fluid" style="padding-top:.5%;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://mrbrownbakery.com/image/images/2fuT6oIBEWyXqJWOb6lexWMdcE0s5PZqXnRos8lk.jpeg?p=main_slider" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://d2qawt1kg5db6p.cloudfront.net/wp-content/uploads/2020/04/02163003/sliderbanner-used.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images.motorcar.com/sites/10730/homepagelibrary/102008_10730.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://dealerinspire1.s3.us-east-1.amazonaws.com/JjygFvx85UTKtkX9FD03-NI%3D/CDy2BvBgoiXPo024/Vm3qUg%3D%3D/EzWhQvt7vA%3D%3D/header.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container" style="padding:3%;">
        <h1 style="color:orange;text-align:left;">ABOUT CARTECH</h1><br>
        <div class="row">
            <div class="col-sm-6">
                <p style="text-align:justify;">CARTECH is a next generation ecommerce platform for pre owned cars. We provide the best in class experience for car buyers by offering a wide assortment of certified cars that are home delivered in a click of a button while sellers get the best price of their vehicles in less than 1 hour.</p>
                <p style="text-align:justify;">Buying a second car sometimes is not an easy task, it requires hours of browsing, multiple test drives and weeks before finding the right one. But with us, it is as simple as browsing through thousands of certified cars and reserving your favorite one by paying a refundable deposit. We’ll deliver the car to your home else you can collect it from a CARTECH hub near you. And if you don’t like your car, return it and get a complete refund within seven days. </p>
                <p style="text-align:justify;">Over the years we’ve simplified car selling! One can sell their car from their home or our branch in less than 1 hour and get the best price instantly. We also take care of ownership (RC) transfer for free.</p>
            </div>
            <div class="col-sm-6">
                <img style="height:100%;width:100%;" src="https://www.impactplus.com/hs-fs/hubfs/blog-image-uploads/best-about-us-pages.jpg?length=1200&name=best-about-us-pages.jpg" alt="About" />
            </div>
        </div>
    </div>
    <div class="container" style="padding-left:3%;padding-right:3%;padding-bottom:3%;">
        <h1 style="color:orange;text-align:left;">Selling with CARTECH</h1><br>
        <p><b>Sell from anywhere:</b>Book an appointment for an inspection at your home or at any of our 200+ branches.</p>
        <p><b>Sell car at the best price:</b>With our live auction, get the best offers from thousands of buyers from across the country. </p>
        <p><b>Sell car in 1 hour:</b>Our entire car selling process takes less than 1 hour.</p>
        <p><b>Get instant payment:</b>The moment we buy your car, the payment is transferred to your bank account.</p>
        <p><b>Free RC transfer:</b>CARSTECH takes care of the ownership transfer / RC Transfer on behalf of you.</p>
    </div>
    <div class="container" style="padding-left:3%;padding-right:3%;padding-bottom:3%;">
        <h1 style="color:orange;text-align:left;">OUR STAFF</h1><br>
        <div class='container mx-auto mt-5 col-md-10 mt-100'>
            <div class="card-group" style="justify-content:center;text-align:center;">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583336/AAA/4.jpg"> </div>
                            <div class="card-title"> <b> Angelina Frederic</b><br /> <small>CEO of K mart</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583319/AAA/3.jpg"> </div>
                            <div class="card-title"> <b>Jackson Totham</b><br /> <small>CEO of Redbull</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Sundar_Pichai_%28cropped1%29.jpg/220px-Sundar_Pichai_%28cropped1%29.jpg"> </div>
                            <div class="card-title"><b>Sundar Pichai</b><br /> <small>CEO of Google</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg"> </div>
                            <div class="card-title">
                                <b>David Gregory</b><br /> <small>Resident Dj at ibdc</small>
                            </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
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