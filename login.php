<?php
  include_once "connection.php";
  ob_start();
  session_start();
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
  <title>Login page</title>
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
  <section class="vh-100" style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bg.jpg');background-position:center;background-size:cover;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="flex-grow-1 col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="lform.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height:100%;width:100%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p- p-lg-5 text-black">

                  <form action="login.php" method="post">

                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h3>

                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example17" name="em" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" name="pwd" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <input type="submit" value="Login" class="btn btn-outline-warning btn-lg btn-block" name="btnl">
                    </div>
                    <p class="mb-1 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php" class="text-decoration-none" style="color: #393f81;">Register here</a></p>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;"><a href="forget_pwd_form.php" class="text-decoration-none" style="color: #393f81;">Forgot Password?</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
    include_once "footer.php";
    if(isset($_POST['btnl']))
    {
      $email=$_POST['em'];
      $password=$_POST['pwd'];
      $q="select * from user where email='".$email."' AND password='".$password."'";
      $result= mysqli_query($con,$q);
      $row=mysqli_fetch_assoc($result);
      if($row["role"]=="user")
      {
        $_SESSION['em']=$email;
        $_SESSION['pwd']=$password;
        $_SESSION['role']="user";
        header('Location:user_view.php');
      }
      elseif($row["role"]=="admin")
      {
        $_SESSION['em']=$email;
        $_SESSION['pwd']=$password;
        $_SESSION['role']="admin";
        header('Location:admin_view.php');
      }
      else
      {
        echo '<script type="text/javascript">alert("Invalid Email or Password")</script>';
      }
    }
  ?>
</body>

</html>