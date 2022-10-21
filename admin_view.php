<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "admin") {
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
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .accordion {
                margin: 40px 0;
            }

            .accordion .item {
                border: none;
                margin-bottom: 50px;
                background: none;
            }

            .t-p {
                padding: 40px 30px 0px 30px;
            }

            .accordion .item .item-header h2 button.btn.btn-link {
                background: #333435;
                color: white;
                border-radius: 0px;
                font-family: "Poppins";
                font-size: 16px;
                font-weight: 400;
                line-height: 2.5;
                text-decoration: none;
            }

            .accordion .item .item-header {
                border-bottom: none;
                background: transparent;
                padding: 0px;
                margin: 2px;
            }

            .accordion .item .item-header h2 button {
                color: white;
                font-size: 20px;
                padding: 15px;
                display: block;
                width: 100%;
                text-align: left;
            }

            .accordion .item .item-header h2 i {
                float: right;
                font-size: 30px;
                color: #eca300;
                background-color: black;
                width: 60px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
            }

            button.btn.btn-link.collapsed i {
                transform: rotate(0deg);
            }

            button.btn.btn-link i {
                transform: rotate(180deg);
                transition: 0.5s;
            }

            #profile {
                height: 15%;
                width: 15%;
            }

            #temp {
                text-align: center;
            }

            #product {
                height: 100%;
                width: 100%;
            }

            @media(max-width:991px) {
                #profile {
                    height: 100%;
                    width: 100%;
                }
            }
        </style>
        <title>Admin Dashboard</title>
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
                            <a class="nav-link active" aria-current="page" href="admin_view.php" style="color:#ffcb3d;">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">Notification</a>
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


        <!-- main container -->
        <div class="container">
            <div class="accordion" id="accordionExample">
                <!-- user table -->
                <div class="item">
                    <div class="item-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Table 1:- user
                                <i class="fa fa-eye"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="t-p">
                            <div style="overflow-x:auto;">
                                <?php
                                $q = "select * from user";
                                $result = mysqli_query($con, $q);
                                ?>
                                <table class="table table-striped">
                                    <tr>
                                        <th>uid</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>password</th>
                                        <th id="temp">profile</th>
                                        <th>role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                            <tr>
                                                <td><?php echo $row['uid']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['password']; ?></td>
                                                <td id="temp"><img class="img-fluid rounded-circle" id="profile" src="profile_pictures/<?php echo $row['profile']; ?>" /></td>
                                                <td><?php echo $row['role']; ?></td>
                                                <td>
                                                    <form action="edit_user.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['uid'] ?>" name="edit_user" />
                                                        <input type="submit" value="Edit" class="btn btn-secondary" name="edit_user_btn" />
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="edit_user.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['uid'] ?>" name="del_user" />
                                                        <input type="submit" value="Delete" class="btn btn-danger" name="del_user_btn" />
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found.";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- contact Table -->
                <div class="item">
                    <div class="item-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Table 2:-contact
                                <i class="fa fa-eye"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="t-p">
                            <div style="overflow-x:auto;">
                                <?php
                                $q = "select * from contact";
                                $result = mysqli_query($con, $q);
                                ?>
                                <table class="table table-striped">
                                    <tr>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>massage</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['massage']; ?></td>
                                                <td>
                                                    <form action="edit_contact.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['email'] ?>" name="edit_contact" />
                                                        <input type="submit" value="Edit" class="btn btn-secondary" name="edit_contact_btn" />
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="edit_contact.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['email'] ?>" name="del_contact" />
                                                        <input type="submit" value="Delete" class="btn btn-danger" name="del_contact_btn" />
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found.";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- products table -->
                <div class="item">
                    <div class="item-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Table 3:-products
                                <i class="fa fa-eye"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="t-p">
                            <div style="overflow-x:auto;">
                                <?php
                                $q = "select * from products";
                                $result = mysqli_query($con, $q);
                                ?>
                                <table class="table table-striped">
                                    <tr>
                                        <th>p_id</th>
                                        <th>car_compney</th>
                                        <th>car_purch_year</th>
                                        <th>car_name</th>
                                        <th>car_model</th>
                                        <th>car_hestory</th>
                                        <th>kms_driven</th>
                                        <th>last_service</th>
                                        <th>reg_no</th>
                                        <th>owner</th>
                                        <th>fual_type</th>
                                        <th>type</th>
                                        <th>insurance</th>
                                        <th>price</th>
                                        <th>img1</th>
                                        <th>img2</th>
                                        <th>img3</th>
                                        <th>img4</th>
                                        <th>img5</th>
                                        <th>img6</th>
                                        <th>status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                            <tr>
                                                <td><?php echo $row['p_id']; ?></td>
                                                <td><?php echo $row['car_compney']; ?></td>
                                                <td><?php echo $row['car_purch_year']; ?></td>
                                                <td><?php echo $row['car_name']; ?></td>
                                                <td><?php echo $row['car_model']; ?></td>
                                                <td><?php echo $row['car_hestory']; ?></td>
                                                <td><?php echo $row['kms_driven']; ?></td>
                                                <td><?php echo $row['last_service']; ?></td>
                                                <td><?php echo $row['reg_no']; ?></td>
                                                <td><?php echo $row['owner']; ?></td>
                                                <td><?php echo $row['fual_type']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['insurance']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img1']; ?>" /></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img2']; ?>" /></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img3']; ?>" /></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img4']; ?>" /></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img5']; ?>" /></td>
                                                <td><img id="product" src="Product_images/<?php echo $row['img6']; ?>" /></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td>
                                                    <form action="edit_products.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['p_id'] ?>" name="edit_products" />
                                                        <input type="submit" value="Edit" class="btn btn-secondary" name="edit_products_btn" />
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="edit_products.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['p_id'] ?>" name="del_products" />
                                                        <input type="submit" value="Delete" class="btn btn-danger" name="del_products_btn" />
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found.";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- orders Table -->
                <div class="item">
                    <div class="item-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Table 4:-orders
                                <i class="fa fa-eye"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                        <div class="t-p">
                            <div style="overflow-x:auto;">
                                <?php
                                $q = "select * from orders";
                                $result = mysqli_query($con, $q);
                                ?>
                                <table class="table table-striped">
                                    <tr>
                                        <th>ord_id</th>
                                        <th>fname</th>
                                        <th>lname</th>
                                        <th>email</th>
                                        <th>mobile_no</th>
                                        <th>address</th>
                                        <th>p_id</th>
                                        <th>staus</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                            <tr>
                                                <td><?php echo $row['ord_id']; ?></td>
                                                <td><?php echo $row['fname']; ?></td>
                                                <td><?php echo $row['lname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['mobile_no']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['p_id']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td>
                                                    <form action="edit_orders.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['ord_id'] ?>" name="edit_orders"/>
                                                        <input type="submit" value="Edit" class="btn btn-secondary" name="edit_orders_btn"/>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="edit_orders.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['ord_id'] ?>" name="del_orders" />
                                                        <input type="submit" value="Delete" class="btn btn-danger" name="del_orders_btn" />
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found.";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- seller table -->
                <div class="item">
                    <div class="item-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Table 5:-seller
                                <i class="fa fa-eye"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="t-p">
                            <div style="overflow-x:auto;">
                                <?php
                                $q = "select * from seller";
                                $result = mysqli_query($con, $q);
                                ?>
                                <table class="table table-striped">
                                    <tr>
                                        <th>seller_id</th>
                                        <th>fname</th>
                                        <th>lname</th>
                                        <th>car_compney</th>
                                        <th>car_name</th>
                                        <th>car_model</th>
                                        <th>fual_type</th>
                                        <th>kms_driven</th>
                                        <th>owner</th>
                                        <th>reg_no</th>
                                        <th>type</th>
                                        <th>car_purch_year</th>
                                        <th>insurance</th>
                                        <th>mobile_no</th>
                                        <th>email</th>
                                        <th>document</th>
                                        <th>img1</th>
                                        <th>img2</th>
                                        <th>img3</th>
                                        <th>img4</th>
                                        <th>img5</th>
                                        <th>img6</th>
                                        <th>status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>


                                            <tr>
                                                <td><?php echo $row['seller_id']; ?></td>
                                                <td><?php echo $row['fname']; ?></td>
                                                <td><?php echo $row['lname']; ?></td>
                                                <td><?php echo $row['car_compney']; ?></td>
                                                <td><?php echo $row['car_name']; ?></td>
                                                <td><?php echo $row['car_model']; ?></td>
                                                <td><?php echo $row['fual_type']; ?></td>
                                                <td><?php echo $row['kms_driven']; ?></td>
                                                <td><?php echo $row['owner']; ?></td>
                                                <td><?php echo $row['reg_no']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['car_purch_year']; ?></td>
                                                <td><?php echo $row['insurance']; ?></td>
                                                <td><?php echo $row['mobile_no']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['document']; ?></td>
                                                <td><?php echo $row['img1']; ?></td>
                                                <td><?php echo $row['img2']; ?></td>
                                                <td><?php echo $row['img3']; ?></td>
                                                <td><?php echo $row['img4']; ?></td>
                                                <td><?php echo $row['img5']; ?></td>
                                                <td><?php echo $row['img6']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td>
                                                    <form action="edit_seller.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['seller_id'] ?>" name="edit_seller"/>
                                                        <input type="submit" value="Edit" class="btn btn-secondary" name="edit_seller_btn"/>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="edit_seller.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['seller_id'] ?>" name="del_seller" />
                                                        <input type="submit" value="Delete" class="btn btn-danger" name="del_seller_btn" />
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found.";
                                    }
                                    ?>
                                </table>
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
} else {
    header("location:login.php");
}
?>