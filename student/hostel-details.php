<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
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

<body style="font-family: Raleway;">
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">My Hostel Details</h4>
                </div>                
                <div class="card">
                   <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="zctb" class="table table-striped table-bordered no-wrap">
                                    <tbody>
                                    <?php	
                                        $cms=$_SESSION['cms'];
                                        $ret="Call StudentDetails('$cms')";
                                        $res=$mysqli->query($ret);
                                        $cnt = 1;
                                        while($row=$res->fetch_object())
                                            {
                                                // $hostel = mysqli_query($mysqli, "SELECT HName from hostel where HID=$row->SHID")->fetch_object()->HName;
                                                // $roomtype = mysqli_query($mysqli, "SELECT RCapacity from room where RNo=$row->SRNo and RHID=$row->SHID")->fetch_object()->RCapacity;
                                                ?>

                                            <tr>
                                            
                                            <td><b>Hostel Name :</b></td>
                                            <td><?php echo $row->HName;?></td>
                                            <td><b>Room no :</b></td>
                                            <td><?php echo $row->SRNo;?></td>
                                            <td><b>Room Type :</b></td>
                                            <td><?php 
                                                if($row->RCapacity == 2)
                                                    echo "Biseater";
                                                else if($row->RCapacity == 3)
                                                    echo "Triseater";
                                                
                                            ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Full Name :</b></td>
                                                <td><?php echo $row->SName ?></td>
                                                <td><b>Guardian Name :</b></td>
                                                <td><?php echo $row->S_FName;?></td>
                                            <td><b>Registration Number :</b></td>
                                            <td><?php echo $row->CMS;?></td>
                                    
                                            </tr>

                                            <tr>
                                            <td><b>Email Address:</b></td>
                                            <td><?php echo $row->SEmail;?></td>
                                            <td><b>Department</b></td>
                                            <td><?php echo $row->Dept;?></td>
                                            <td><b>Contact Number :</b></td>
                                            <td><?php echo $row->SPhone;?></td>
                                            </tr>

                                            <tr>
                                            <td><b>Aadhaar No :</b></td>
                                            <td><?php echo $row->SCnic;?></td>
                                            <td><b>Gender :</b></td>
                                            <td><?php echo $row->SGender;?></td>
                                            <td><b>Current Address:</b></td>
                                            <td colspan="2">
                                            <?php echo $row->SAddress;?></td>
                                            </tr>

                                            <?php
                                            $cnt=$cnt+1;
                                            } ?>

                                    </tbody>
                                </table>      
                            </div>
                        </div>
                    </div>
                </div>
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