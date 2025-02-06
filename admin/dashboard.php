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
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <style>
        .content {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }
    </style>

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
                        <?php include 'includes/greetings-a.php' ?>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="background:linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);">
                            <h2 class="card-title text-center" style="color: white;"><?php echo $_SESSION['Hname'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- INout -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- collapsible title content -->
                                <button type="button" style="outline:none;background:linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);width: -webkit-fill-available;border: 0px;padding-top: 16px;" class="collapsible">
                                    <h4 class="card-title" style="color:white">Students IN OUT</h4><i class="far fa-arrow-alt-circle-down" style="color:white"></i>
                                </button>
                                <div class="table-responsive content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Room No</th>
                                                <th class="border-top-0">Department</th>
                                                <th class="border-top-0">Going Date</th>
                                                <th class="border-top-0">Return Date</th>
                                                <th class="border-top-0">City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hid = $_SESSION['Hid'];
                                            $query = "call in_out('$hid')";
                                            $result = mysqli_query($mysqli, $query);

                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['SName'] . "</td>";
                                                echo "<td>" . $row['SRNo'] . "</td>";
                                                echo "<td>" . $row['Dept'] . "</td>";
                                                echo "<td>" . $row['LeaveDate'] . "</td>";
                                                echo "<td>" . $row['ReturnDate'] . "</td>";
                                                echo "<td>" . $row['City'] . "</td>";
                                                echo "</tr>";
                                            }
                                            mysqli_free_result($result);
                                            mysqli_next_result($mysqli);

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messoff -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- collapsible title content -->
                                <button type="button" style="outline:none;background:linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);width: -webkit-fill-available;border: 0px;padding-top: 16px;" class="collapsible">
                                    <h4 class="card-title" style="color:white">Students Mess Off</h4><i class="far fa-arrow-alt-circle-down" style="color:white"></i>
                                </button>
                                <div class="table-responsive content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Room No</th>
                                                <th class="border-top-0">CMS</th>
                                                <th class="border-top-0">Start Date</th>
                                                <th class="border-top-0">End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hid = $_SESSION['Hid'];
                                            $query = "call mess_off('$hid')";
                                            $result = mysqli_query($mysqli, $query);

                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['SName'] . "</td>";
                                                echo "<td>" . $row['SRNo'] . "</td>";
                                                echo "<td>" . $row['CMS'] . "</td>";
                                                echo "<td>" . $row['MSDate'] . "</td>";
                                                echo "<td>" . $row['MEDate'] . "</td>";
                                                echo "</tr>";
                                            }
                                            mysqli_free_result($result);
                                            mysqli_next_result($mysqli);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complaints -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- collapsible title content -->
                                <button type="button" style="outline:none;background:linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);width: -webkit-fill-available;border: 0px;padding-top: 16px;" class="collapsible">
                                    <h4 class="card-title" style="color:white">Complaints</h4><i class="far fa-arrow-alt-circle-down" style="color:white"></i>
                                </button>
                                <div class="table-responsive content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Room No</th>
                                                <th class="border-top-0">Date</th>
                                                <th class="border-top-0">Complain Type</th>
                                                <th class="border-top-0">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hid = $_SESSION['Hid'];
                                            $query = "call comp('$hid')";
                                            $result = mysqli_query($mysqli, $query);

                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['RNo'] . "</td>";
                                                echo "<td>" . $row['CDate'] . "</td>";
                                                echo "<td>" . $row['CType'] . "</td>";
                                                echo "<td>" . $row['CDescription'] . "</td>";
                                                echo "</tr>";
                                            }
                                            mysqli_free_result($result);
                                            mysqli_next_result($mysqli);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Students Visitors -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- collapsible title content -->
                                <button type="button" style="outline:none;background:linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);width: -webkit-fill-available;border: 0px;padding-top: 16px;" class="collapsible">
                                    <h4 class="card-title" style="color:white">Students Visitors</h4><i class="far fa-arrow-alt-circle-down" style="color:white"></i>
                                </button>
                                <div class="table-responsive content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Student Name</th>
                                                <th class="border-top-0">Vistor</th>
                                                <th class="border-top-0">Relation</th>
                                                <th class="border-top-0">Date</th>
                                                <th class="border-top-0">Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hid = $_SESSION['Hid'];
                                            $query = "call get_visitors('$hid')";
                                            $result = mysqli_query($mysqli, $query);

                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['SName'] . "</td>";
                                                echo "<td>" . $row['SRNo'] . "</td>";
                                                echo "<td>" . $row['VName'] . "</td>";
                                                echo "<td>" . $row['VRelation'] . "</td>";
                                                echo "<td>" . $row['VDate'] . "</td>";
                                                echo "<td>" . $row['VReason'] . "</td>";
                                                echo "</tr>";
                                            }
                                            mysqli_free_result($result);
                                            mysqli_next_result($mysqli);
                                            ?>
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
        <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            }
        </script>
</body>

</html>