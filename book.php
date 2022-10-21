<?php 
    include_once "connection.php";
?>
<?php
    if(isset($_POST['btn_cof']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $mno=$_POST['mno'];
        $addres=$_POST['addres'];
        $pid=$_POST['pid'];
        $q="insert into orders values ('','$fname','$lname','$email','$mno','$addres','$pid','panding')";
        if(mysqli_query($con,$q))
        {
            echo "<script type='text/javascript'>alert('car booked successfully!');</script>";
            echo "<script type='text/javascript'>alert('our team will contact you in 24 hour.!')</script>";
            echo "<script type='text/javascript'>window.location='user_view.php'</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('error! :)');</script>";
            echo "<script type='text/javascript'>window.location='details.php'</script>";
        }
    }
?>