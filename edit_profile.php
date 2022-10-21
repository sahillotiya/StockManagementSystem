<?php
    include_once "connection.php";
    ob_start();
    session_start();
?>
<?php
    if(isset($_POST['btnep']))
    {
        $name = $_POST['nm'];
        $email = $_POST['em'];
        $q="update user set name='$name',email='$email' where email='".$_SESSION['em'].  
        "'";
        if(mysqli_query($con,$q))
        {
            echo '<script type="text/javascript">alert("Profile Updated Successfully!")</script>';
            if($_SESSION['role']=="admin")
            {
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            }
            else
            {
                echo '<script type="text/javascript">window.location="user_view.php"</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">alert("Error!")</script>';
            if($_SESSION['role']=="admin")
            {
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            }
            else
            {
                echo '<script type="text/javascript">window.location="user_view.php"</script>';
            }
        }
    }
?>
<?php
    if(isset($_POST['btnepp']))
    {
        if ($_FILES['new_ppic']['name'] == "") 
        {
            echo "<script type='text/javascript'> alert('please select a file')</script>";
            echo "<script type='text/javascript'>window.location='admin_view.php'</script>";
        } 
        else 
        {
            if ($_FILES['new_ppic']['size'] >= 204000) 
            {
                echo "<script type='text/javascript'> alert('please select a file with size less than 200KB')</script>";
                if($_SESSION['role']=="admin")
                {
                    echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                }
                else
                {
                    echo '<script type="text/javascript">window.location="user_view.php"</script>';
                }
            } 
            else 
            {
                if ($_FILES['new_ppic']['type'] == "image/jpeg" || $_FILES['new_ppic']['type'] == "image/png") 
                {
                    $pic_name = uniqid() . $_FILES['new_ppic']['name'];
                    move_uploaded_file($_FILES['new_ppic']['tmp_name'], "profile_pictures/" . $pic_name);
                    $q = "update user set profile='$pic_name' where email='".$_SESSION['em']."'";
                    if (mysqli_query($con,$q)) 
                    {
                        echo "<script type='text/javascript'> alert('Profile Picture Updated Successfully!')</script>";
                        if($_SESSION['role']=="admin")
                        {
                            echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                        }
                        else
                        {
                            echo '<script type="text/javascript">window.location="user_view.php"</script>';
                        }
                    } 
                    else 
                    {
                        echo $q;
                        echo "<script type='text/javascript'> alert('Errror');</script>";
                        if($_SESSION['role']=="admin")
                        {
                            echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                        }
                        else
                        {
                            echo '<script type="text/javascript">window.location="user_view.php"</script>';
                        }
                    }
                } 
                else 
                {
                    echo "<script type='text/javascript'> alert('please select a file jpeg or png')</script>";
                    if($_SESSION['role']=="admin")
                    {
                        echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript">window.location="user_view.php"</script>';
                    }
                }
            }
        }
    }
?>
<?php
    if(isset($_POST['btncp']))
    {
        $opwd=$_POST['opwd'];
        $npwd=$_POST['npwd'];
        $cnpwd=$_POST['cnpwd'];
        $q="select * from user where email='".$_SESSION['em']."'";
        $result=mysqli_query($con,$q);
        $row=mysqli_fetch_array($result);
        if($row['password']==$opwd)
        {
            if($npwd==$cnpwd)
            {
                $q1="update user set password='$npwd' where email='".$_SESSION['em']."'";
                if(mysqli_query($con,$q1))
                {
                    echo '<script type="text/javascript">alert("password changed successfully!");</script>';
                    if($_SESSION['role']=="admin")
                    {
                        echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript">window.location="user_view.php"</script>';
                    }
                }
                else
                {
                    echo '<script type="text/javascript">alert("error!");</script>';
                    if($_SESSION['role']=="admin")
                    {
                        echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript">window.location="user_view.php"</script>';
                    }
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("new password and confirm new password does not match");</script>';
                if($_SESSION['role']=="admin")
                {
                    echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                }
                else
                {
                    echo '<script type="text/javascript">window.location="user_view.php"</script>';
                }
            }
        }
        else
        {
            echo '<script type="text/javascript">alert("old password does not match");</script>';
            if($_SESSION['role']=="admin")
            {
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            }
            else
            {
                echo '<script type="text/javascript">window.location="user_view.php"</script>';
            }
        }
    }
?>