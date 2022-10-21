<?php
include_once "connection.php";
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
    <script type="text/javascript" src="main.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <title>Register page</title>
    <style>
        #temp {
            margin-left: 20.5rem;
        }

        @media(max-width:991px) {
            #temp {
                margin-left: 12.2rem;
            }
        }
    </style>
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
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
    <section class="h-100 h-custom" style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bg.jpg');background-position:center;background-size:cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="rlable.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>
                            <form class="px-md-2" method="post" onsubmit="return(btnr_click());" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <input type="text" name="nm" id="t1" class="form-control"/>
                                    <label class="form-label" for="forname">Name</label>
                                    <p id="p1"></p>
                                </div>
                                <div class="mb-4">
                                    <input type="text" id="t2" name="em" class="form-control">
                                    <label class="form-label" for="foremail">E-mail</label>
                                    <p id="p2"></p>
                                </div>
                                <div class="mb-4">
                                    <input type="password" id="t3" name="pwd" class="form-control"/>
                                    <label class="form-label" for="forpasswoord">Password</label>
                                    <p id="p3"></p>
                                </div>
                                <div class="mb-4">
                                    <input type="file" class="form-control" name="p_pic">
                                    <label for="pwd">Profile Picture:</label>
                                </div>
                                <input type="submit" name="btnr" id="temp" value="Register" class="btn btn-outline-warning btn-lg mb-1" /><br><br>
                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Have already an account?
                                    <a href="login.php" class="text-decoration-none" style="color: #393f81;">Login here</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
        include_once "footer.php";
        if (isset($_POST['btnr'])) 
        {
            $name = $_POST['nm'];
            $email = $_POST['em'];
            $password = $_POST['pwd'];
            if ($_FILES['p_pic']['name'] == "") 
            {
                echo "<script type='text/javascript'> alert('please select a file')</script>";
                echo "<script type='text/javascript'>window.location='register.php';</script>";
            } 
            else 
            {
                if ($_FILES['p_pic']['size'] >= 204000) 
                {
                    echo "<script type='text/javascript'> alert('please select a file with size less than 200KB')</script>";
                    echo " <script type='text/javascript'>window.location='register.php';</script>";
                } 
                else 
                {
                    if ($_FILES['p_pic']['type'] == "image/jpeg" || $_FILES['p_pic']['type'] == "image/png") 
                    {
                        $pic_name = uniqid() . $_FILES['p_pic']['name'];
                        move_uploaded_file($_FILES['p_pic']['tmp_name'], "profile_pictures/" . $pic_name);
                        $q = "INSERT INTO `user`(`uid`, `name`, `email`, `password`, `profile`, `role`) VALUES('','$name','$email','$password','$pic_name','user')";
                        if (mysqli_query($con,$q)) 
                        {
                            echo "<script type='text/javascript'> alert('Registration successful')</script>";
                            echo "</script type='text/javascript'>window.location='Login.php';</script>";
                        } 
                        else 
                        {
                            echo $q;
                            echo "<script type='text/javascript'> alert('Errror in Registration');";
                            echo "<script type='text/javascript'>window.location='registration.php'</script>";
                        }
                    } 
                    else 
                    {
                        echo "<script type='text/javascript'> alert('please select a file jpeg or png');";
                        echo "<script type='text/javascript'>window.location='registration.php';</script>";
                    }
                }
            }
        }
    ?>
</body>

</html>