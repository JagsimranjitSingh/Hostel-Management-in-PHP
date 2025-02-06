<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    if(isset($_POST['submit']))
    {
        $fee=$_POST['fee'];
        $due=$_POST['due'];
        $status="unpaid";
        $type = $_POST['type'];
        $hid = $_SESSION['Hid'];
        $ret="SELECT * from student where shid= $hid";
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute() ;
        $res=$stmt->get_result();
        while($row=$res->fetch_object())
        {
            $cms=$row->CMS;
            $sql=mysqli_query($mysqli,"insert into invoice(cms,iamount,itype,iduedate,status) values('$cms','$fee','$type','$due','$status')");
        }
        if($sql)
        {
            echo "<script>alert('Student Fee updated successfully');</script>";
            echo "<script>window.location.href ='fee.php'</script>";
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

    <script>
    function getSeater(val) {
       
        }
    </script>
    
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
            <?php include 'includes/navigation.php'?>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Fee Affair</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

            <form method="POST">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fee</h4>
                                    <div class="form-group">
                                        <input type="text" name="fee" id="stayf" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Type</h4>
                                    <div class="form-group">
                                        <select name="type" id="stayf" class="form-control" required>
                                            <option value="Hostel">Hostel</option>
                                            <option value="Mess">Mess</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Due Date</h4>
                                    <div class="form-group">
                                        <input type="date" name="due" id="stayf" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>                           
                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Generate</button>
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

<script type="text/javascript">
	$(document).ready(function(){
        
    });
    </script>
    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        
        }
    </script>

    <script type="text/javascript">

    $(document).ready(function() {
        $('#duration').keyup(function(){
            
            }
        )});
    </script>
</body>

</html>