<?php
session_start();
include_once "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');
//date_default_timezone_set("Asia/Kolkata");
//$db_time=date("Y-m-d G:i:s", strtotime("- 5 min"));
?>
<html>
<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
	<link rel="stylesheet" href="login.css" />
    <!-- Bootstrap CSS --><script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
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

                  <form action="forget_pwd_form.php" method="post">

                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h3>

                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example17" name="em" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>

                    <div class="pt-1 mb-4">
					<a href="login.php" class="btn btn-outline-danger btn-lg">Cancle</a>&nbsp;
                      <input type="submit" value="Send" class="btn btn-outline-warning btn-lg btn-block" name="sub">
                    </div>
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
if (isset($_POST['sub'])) {
	$em = $_POST['em'];

	$q = "select * from user where email='$em'";
	$count = mysqli_num_rows(mysqli_query($con, $q));
	if ($count == 1) {
		$q1 = "select * from token1 where Email='$em'";
		$countem = mysqli_num_rows(mysqli_query($con, $q1));
		if ($countem == 1) {
			echo "<script type='text/javascript'>alert('A Password reset link is already sent to your mail please check. New link will be generated after old link expires');</script>";
		} else {
			date_default_timezone_set("Asia/Kolkata");
			$s_time = date("Y-m-d G:i:s", strtotime("+ 30 min"));

			$token = hash('sha512', $s_time);
			$otp = mt_rand(100000, 999999);
			$ins_token = "INSERT INTO token1 VALUES ('','$em','$s_time','$token',$otp)";
			// echo "$ins_token";
			//$db_time = date("Y-m-d G:i:s", strtotime("+ 30 min"));
			//$_SESSION['db_time'] = $db_time;
			if (mysqli_query($con, $ins_token)) {
				$link = "http://localhost/CAR%20WEBSITE/verify_otp.php?email=$em&token=$token";
				//echo $link;
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'rramani481@rku.ac.in';                     //SMTP username
					$mail->Password   = 'R7845580';                               //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
					$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('rramani481@rku.ac.in', 'Old Car Seller Website');
					$mail->addAddress($em, 'Raj Ramani');     //Add a recipient
					//$mail->addAddress('ellen@example.com');               //Name is optional
					$mail->addReplyTo('rramani481@rku.ac.in', 'Reply');
					//$mail->addCC('cc@example.com');
					// $mail->addBCC('bcc@example.com');

					//Attachments
					// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
					//  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'Password reset link for Student Demo Website';
					$mail->Body    = 'OTP for password reset is ' . $otp . ' <br/>This is the password reset link for your account with Old Car Seller Website .The link is valid for 24 hours.=> ' . @$link .  "<br/> Please use forgot password facility again if the link has expired";
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if ($mail->send()) {
						echo '<script>alert("Password reset link has been sent to your registered email.Please check the spam also.");</script>';
					}
				} catch (Exception $e) {
					//	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					echo '<script>alert("Failed to reset the password please try again after sometime.");</script>';
				}
			}
		}
	} else {
		echo "<script type='text/javascript'>alert('No such Email address is registered'); window.location='forget_pwd_form.php';</script>";
	}
}
?>
</body>
</html>