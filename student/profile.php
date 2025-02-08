<?php
    session_start();
    include('../includes/dbconn.php');
    date_default_timezone_set('America/Chicago');
    include('../includes/check-login.php');
    check_login();
    $cms=$_SESSION['cms'];
    if(isset($_POST['update']))
    {
    $SName=$_POST['name'];
    $contactno=$_POST['contact'];
    $dept=$_POST['dept'];
    $address=$_POST['address'];
    $query="UPDATE  student set SName=?,SPhone=?,Dept=?,SAddress=? where cms=?";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('ssssi',$SName,$contactno,$dept,$address,$cms);
    $stmt->execute();
    echo"<script>alert('Profile updated Succssfully');</script>";
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
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/student-navigation.php'?>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Profile</h4>
                </div>
                <div class="row">
                    <?php	
                    $cms=$_SESSION['cms'];
                    $ret="select * from student where CMS=$cms";
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                        //$cnt=1;
                        while($row=$res->fetch_object())
                        {
                    ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registration Number</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $row->CMS;?>" required readonly>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <form name="registration" onSubmit="return valid();" method="POST">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Name</h4>
                                    <div class="form-group">
                                        <input type="text" name="name" id="fname" class="form-control" value="<?php echo $row->SName;?>"   required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email Address</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $row->SEmail;?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Address</h4>
                                    <div class="form-group">
                                        <input type="text" name="address" id="address" class="form-control" value="<?php echo $row->SAddress;?>"   required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Department</h4>
                                    <div class="form-group">
                                        <input type="text" name="dept" id="dept" class="form-control" value="<?php echo $row->Dept;?>"  required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Contact Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="contact" id="contact" maxlength="10" class="form-control" value="<?php echo $row->SPhone;?>" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    
                    </div>
                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success">Make Changes</button>
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
</body>

</html>