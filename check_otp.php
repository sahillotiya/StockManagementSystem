<?php
session_start();

include_once("connection.php");
if (isset($_POST['submit']))
{
  $login_id = $_SESSION['em'];
  $token = $_SESSION['token'];
  $otp = $_POST['otp'];
 
  $q = "select * from token1 WHERE Email='$login_id' and token='$token'";

  $t = mysqli_query($con, $q);
  $count = mysqli_num_rows($t);
  
  if ($count > 0) 
  {
    while ($res = mysqli_fetch_array($t)) 
    {
      $em = $res[1];
      $token = $res[3];
      $_SESSION['em'] = $em;
      $_SESSION['token'] = $token;
      if ($otp == $res[4]) 
      {
      
        echo "<script type='text/javascript'>alert('OTP matched.');</script>";
        echo "<script type='text/javascript'> window.location.href='change_password_form.php';</script>'";
      } 
      else 
      { ?>
        <script type="text/javascript">
          alert("OTP is incorrect");
          window.location.href = "verify_otp.php";
        </script>
    <?php
      }
    }
  }
  else 
  { ?>
    <script type="text/javascript">
      alert("Password reset token expired.");
      window.location.href = "login.php";
    </script>
<?php
   }
}
?>