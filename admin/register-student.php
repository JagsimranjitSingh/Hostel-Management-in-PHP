<?php
    session_start();
    include('../includes/dbconn.php');
    if (isset($_POST['submit'])) {
        $CMS = $_POST['cms'];
        $SCnic = $_POST['cnic'];
        $SEmail = $_POST['email'];
        $query = mysqli_query($mysqli, "Select cms from student where cms='$CMS' OR semail='$SEmail' or scnic='$SCnic'");
        if(mysqli_fetch_array($query)>0){
            echo "<script>alert('Student is already registered!');</script>";
            header("location: register-student.php");
        }
        else{
            $SName = $_POST['name'];
            $S_FName = $_POST['fname'];
            $SAddress = $_POST['address'];
            $SPhone = $_POST['phone'];
            $SGender = $_POST['gender'];
            $Dept = $_POST['dept'];
            $SHID = $_SESSION['Hid'];
            $SRNo = $_POST['room'];
            $Password = $_POST['password'];
            $Password = md5($Password);
            $query = "call register($CMS, '$SName', '$S_FName', '$SAddress', '$SEmail', '$SPhone', '$SCnic', '$SGender', '$Dept', '$SHID' , $SRNo, '$Password')";
            mysqli_query($mysqli, $query);
            echo "<script>alert('Student has been Registered!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.cpassword.value) {
                alert("Password and Confirm Password does not match");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body style="font-family: Raleway;">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php' ?>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php' ?>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Registration Form</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form method="POST" name="registration" onSubmit="return valid();">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">CMS</h4>
                                    <div class="form-group">
                                        <input type="number" name="cms" placeholder="Enter Registration Number" id="regno" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="fname" placeholder="Enter Name" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Father/Guardian Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="fname" id="mname" placeholder="Enter Father/Guardian Name" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                    <div class="form-group">
                                        <input type="text" name="address" id="lname" placeholder="Enter Address" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Aadhaar No</h4>
                                    <div class="form-group">
                                        <input type="number" name="cnic" id="lname" placeholder="Enter Aadhaar No" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gender</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="gender" name="gender" required="required">
                                            <option selected>Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="number" name="phone" id="contact" placeholder="Your Contact" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Department</h4>
                                    <div class="form-group">
                                        <input type="text" name="dept" id="contact" placeholder="Your Department" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Room No.</h4>
                                    <div class="form-group">
                                        <!-- select from available list get from php-->
                                        <select class="custom-select mr-sm-2" id="room" name="room" required="required">
                                            <?php
                                                $id = $_SESSION['Hid'];
                                                $sql = "call free('$id')";
                                                $result = mysqli_query($mysqli, $sql);

                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['rno'] . "'>" . $row['rno'] . "</option>";
                                                }
                                                ;
                                                mysqli_free_result($result);
                                                mysqli_next_result($mysqli);
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email ID</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder="Your Email" onBlur="checkAvailability()" required="required" class="form-control">
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Password</h4>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" placeholder="Enter Password" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Confirm Password</h4>
                                    <div class="form-group">
                                        <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirmation Password" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Register</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php include '../includes/footer.php' ?>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

    <script>
        function checkAvailability() {

            $("#loaderIcon").show();

        }
    </script>
</body>

</html>