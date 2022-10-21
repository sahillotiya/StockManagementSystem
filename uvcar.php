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
    <link rel="stylesheet" href="cars.css"/>
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
                        <a class="nav-link active" style="color:#ffcb3d;" href="uvcar.php">Buy Used Car</a>
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
                    </li>
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
    <?php 
        $q="select * from products where status = 'onsell'";
        $result=mysqli_query($con,$q);
    ?>
    <div class="container pt-3">
        <div class="row">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
            ?>
            <div class="col-md-3 col-sm-12 pb-3">
                <div class="card">
                    <img src="Product_images/<?php echo $row['img1'];?>"/>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['car_purch_year'];echo ' ';echo $row['car_name'];?></h5>
                        <b><?php echo $row['car_model'];echo ' ';echo $row['type'];?></b>
                        <p><?php echo $row['kms_driven'];echo '-';echo $row['owner'];?></p><hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="price pt-2"><?php echo $row['price'];echo "₹";?></h5>
                            </div>
                            <div class="col">
                                <form action="details.php" method="post">
                                    <!-- <a href="book.php" class="btn btn-outline-warning">Buy now</a> -->
                                    <input type="hidden" value="<?php echo $row['p_id'] ?>" name="pid"/>
                                    <input type="submit" class="btn btn-outline-warning" value="BOOK NOW" name="book_btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
                else
                {
                    echo "No Products Uploaded Yet.";
                }
            ?>
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