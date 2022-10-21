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
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f093fb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
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
                        <a class="nav-link" aria-current="page" href="user_view.php"">Home</a>
                    </li>
                    <li class=" nav-item">
                            <a class="nav-link" href="uvcar.php">Buy Used Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#ffcb3d;" href="sell.php">Sell Used Car</a>
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
    <section class="h-100 h-custom" style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bag.jpg');min-height:100vh;width:100%;background-position:center;background-size:cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="rlable.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">

                            <form class="px-md-2" action="sell.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">First Name</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" pattern="[A-Za-z]+" title="letters only" name="fname"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Last Name</label>
                                            <input type="text" required id="lastName" class="form-control form-control-md" pattern="[A-Za-z]+" title="letters only" name="lname"/>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Compony</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" pattern="[A-Za-z]+" title="letters only" name="compony"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Car Name</label>
                                            <input type="text" required id="lastName" class="form-control form-control-md" name="name"/>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Model</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" name="model"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Fuel type</label>
                                            <select required class="select form-control form-control-md" name="ftype">
                                                <option>Patrol</option>
                                                <option>Disel</option=>
                                                <option>CNG</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">KMs Driven</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" name="kms"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Owner</label>
                                            <select required class="select form-control form-control-md" name="owner">
                                                <option>1st Owner</option>
                                                <option>2nd Owner</option>
                                                <option>3rd Owner</option>
                                                <option>4th Owner</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Registration No.</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" name="regno"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Type</label>
                                            <select required class="select form-control form-control-md" name="type">
                                                <option>Manual</option>
                                                <option>Auto</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Year</label>
                                            <select required class="select form-control form-control-md" name="year">
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                                <option>2021</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Insurence</label>
                                            <input type="text" required id="firstName" class="form-control form-control-md" name="insurence"/>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Phone No</label>
                                            <input type="text" required id="firstName" pattern="^\d{10}$" class="form-control form-control-md" title="Please Enter valid mobile-no" name="mno"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Email</label>
                                            <input type="email" required id="lastName" class="form-control form-control-md" name="email"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car RC-Book image</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="document"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car image</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img1"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car image angle-1</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img2"/>
                                </div>


                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car image angle-2</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img3"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car image angle-3</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img4"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car interear image</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img5"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="firstName">Uplode your car speedo-meater image</label>
                                    <input type="file" id="firstName" class="form-control form-control-mg" name="img6"/>
                                </div>

                                <input type="submit" class="btn btn-outline-warning btn-lg mb-1" value="Submit" name="btnsell">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include_once "footer.php";
    ?>
    <?php
        if (isset($_POST['btnsell']))
        {
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $compony=$_POST['compony'];
            $name=$_POST['name'];
            $model=$_POST['model'];
            $ftype=$_POST['ftype'];
            $kms=$_POST['kms'];
            $owner=$_POST['owner'];
            $regno=$_POST['regno'];
            $type=$_POST['type'];
            $year=$_POST['year'];
            $insurence=$_POST['insurence'];
            $mno=$_POST['mno'];
            $email=$_POST['email'];
            if ($_FILES['document']['name'] == "" && $_FILES['img1']['name'] == "" && $_FILES['img2']['name'] == "" && $_FILES['img3']['name'] == "" && $_FILES['img4']['name'] == "" && $_FILES['img5']['name'] == "" && $_FILES['img6']['name'] == "") {
                echo "<script type='text/javascript'> alert('please select a file');";
                echo "window.location='sell.php';</script>";
            } else {
                if ($_FILES['document']['size'] >= 204000 && $_FILES['img1']['size'] >= 204000 && $_FILES['img2']['size'] >= 204000 && $_FILES['img3']['size'] >= 204000 && $_FILES['img4']['size'] >= 204000 && $_FILES['img5']['size'] >= 204000 && $_FILES['img6']['size'] >= 204000) {
                    echo "<script type='text/javascript'> alert('please select a file with size less than 200KB');";
                    echo "window.location='sell.php';</script>";
                } else {
                        $document = uniqid() . $_FILES['document']['name'];
                        move_uploaded_file($_FILES['document']['tmp_name'], "Product_images/" . $document);
                        $img1 = uniqid() . $_FILES['img1']['name'];
                        move_uploaded_file($_FILES['img1']['tmp_name'], "Product_images/" . $img1);
                        $img2 = uniqid() . $_FILES['img2']['name'];
                        move_uploaded_file($_FILES['img2']['tmp_name'], "Product_images/" . $img2);
                        $img3 = uniqid() . $_FILES['img3']['name'];
                        move_uploaded_file($_FILES['img3']['tmp_name'], "Product_images/" . $img3);
                        $img4 = uniqid() . $_FILES['img4']['name'];
                        move_uploaded_file($_FILES['img4']['tmp_name'], "Product_images/" . $img4);
                        $img5 = uniqid() . $_FILES['img5']['name'];
                        move_uploaded_file($_FILES['img5']['tmp_name'], "Product_images/" . $img5);
                        $img6 = uniqid() . $_FILES['img6']['name'];
                        move_uploaded_file($_FILES['img6']['tmp_name'], "Product_images/" . $img6);
                        $q = "INSERT INTO `seller`(`seller_id`, `fname`, `lname`, `car_compney`, `car_name`, `car_model`, `fual_type`, `kms_driven`, `owner`, `reg_no`, `type`, `car_purch_year`, `insurance`, `mobile_no`, `email`, `document`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`,`status`) VALUES ('','$fname','$lname','$compony','$name','$model','$ftype','$kms','$owner','$regno','$type','$year','$insurence','$mno','$email','$document','$img1','$img2','$img3','$img4','$img5','$img6','panding')";
                        if (mysqli_query($con, $q)) {
                            echo "<script type='text/javascript'> alert('Data Submited Successfully!Our Team will be Contact You In 24 Hour!');";
                            echo "window.location='sell.php';</script>";
                        } else {
                            echo $q;
                            echo "<script type='text/javascript'> alert('Errror!');";
                            echo "window.location='sell.php';</script>";
                        }
                }
            }
        }
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