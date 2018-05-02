<?php 
include 'server.php';
$sql = "SELECT * FROM master";
$res = mysqli_query($db, $sql) or die(mysqli_error($db));
if (mysqli_num_rows($res) == 0) {
    echo "<script>alert(\"No master found.\");
    window.location.assign(\"admin/master_register.php\");
    </script>";
}
$tareek = date('d-m-Y');
?>
<!DOCTYPE html>
<html>
<head>
    <?php if ((!isset($_SESSION['username'])) && (!isset($_SESSION['username-admin']))) { ?>
    <title>Home Page</title>
    <?php } else { ?>
    <title>Dashboard</title>
    <?php } ?>
    <?php require 'cdn.php'; ?>
    <style type="text/css">
        <?php require 'short-page-footer-style.css';
        ?>
        .panel-body {
            background-color: #c9c9f2;
            font-size: 17px;
            font-weight: bold;
        }
        .panel-footer {
            font-size: 14px;
        }
        .error {
            color: tomato;
        }
        #login_box {
            margin: auto;
            margin-bottom: 20px;
            border: 1px solid #c9c9f2;
            border-radius: 25px;
            background-color: #c9c9f2;
            padding: 20px;
        }
        .well {
            border: 2px solid gray;
        }
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 20px;
            transition: 0.4s;
        }

        .active, .accordion:hover {
            background-color: #ccc; 
        }

        #panel {
            padding: 0;
            display: none;
            background-color: white;
            overflow: hidden;
        }
        .list-group-item {
            background-color: white;
        }
        .list-group-item:hover {
            background-color: skyblue;
        }

    </style>
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('samay').innerHTML =
            "Time: " + h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>
</head>
<body onload="startTime()">
    <?php require 'welcome.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?php if ((!isset($_SESSION['username'])) && 
                (!isset($_SESSION['username-admin']))) { ?>
                <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-body">Features 1</div>
                    <div class="panel-footer"><p>Cloud based Fixed Assets records helps to store and track always the records of all assets and the position and actual user or is available. The Assets records is exhaustive and is identified for different module as Depreciation, Repairs and Maintenance and Warranty.</p></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">Features 2</div>
                    <div class="panel-footer"><p>The recorded assets has properly been included for escalating matter for AMC and or insurance and lays a report if the same required to be renewed.</p></div>
                </div></div>
                <?php } else { ?>
                <?php if (isset($_SESSION['username-admin'])) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php require 'admin-menu-bar.php'; ?>
                    </div>
                </div>
                <?php } elseif (isset($_SESSION['username'])) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group-item">
                        <a href="index.php">Dashboard</a>
                        </ul>
                        <ul class="list-group-item"><a href="javascript:void(0)" onclick="window.location.replace('items/my_asset_items.php');">My Assets</a>
                        </ul>
                        <ul class="list-group-item"><a href="#">Contact Admin</a>
                        </ul>
                    </div>
                </div>
                <?php } } ?>
            </div>
            <div class="col-sm-6" id="login_box">
                <?php if ((!isset($_SESSION['username'])) && !isset($_SESSION['username-admin'])) { ?>
                    <form method="post" action='index.php'>
                        <div class="error"><?php include 'error.php'; ?></div>
                        <div class="form-group">
                            <input type="text" name="user_name" class="form-control" placeholder="Username" required="True">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass_word" class="form-control" placeholder="Password" required="True">
                        </div>
                        <p style="color: red;">#Note: If you are an user please enter your <u style="color: tomato;">registered mobile number</u> in the <u style="color: tomato;">password field</u>.</p>
                        <input type="submit" name="login_submit" class="btn btn-success" value="Login"><a href="javascript:void(0)" onclick="window.location.replace('password_manager/forgot_password.php');" style="text-decoration: none; font-family: cursive;">  Forgot Password?</a>
                    </form>
                <?php } elseif (isset($_SESSION['username'])) { ?>
                    <div class="well">
                        <b>Profile Details</b>
                        <?php include 'employee/user_profile_detail.php'; ?>
                        <p><em>*You are not authorised to change details. But you may generate a request to the admin for any changes.</em>
                        <hr>
                        <?php $rec = mysqli_query($db, "SELECT * FROM junc WHERE junc_user='".$_SESSION['uid']."'") or die(mysqli_error($db));
                            $things = mysqli_num_rows($rec); ?>
                        <p><strong>No. of assets you have in total: <?php echo $things; ?></strong></p>
                    </div>
                <?php } elseif (isset($_SESSION['username-admin'])) { 
                    require 'items/reg_items.php';
                } ?>
            </div>
            <div class="col-sm-3">
                <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><?php echo "Date: ".$tareek; ?>
                            <div id="samay"></div>
                        </h4>
                        <?php if (isset($_SESSION['username-admin'])) { ?>
                            <h4>Hi, <?php echo $_SESSION['username-admin']; ?></h4>
                            <a href="javascript:void(0)" onclick="window.location.replace('logout.php');"><button class="btn btn-danger">Logout</button></a><br><br>
                            <a href="javascript:void(0)" onclick="window.location.replace('password_manager/change_password.php');"><button class="btn btn-info">Change Password</button></a>
                            <a href="javascript:void(0)" onclick="window.location.replace('log_folder/show_log_data.php');">
                            <button class="btn btn-warning">Log-Data</button></a>
                        <?php } elseif (isset($_SESSION['username'])) { ?>
                            <h4>Hi, <?php echo $_SESSION['username']; ?></h4>
                            <a href="javascript:void(0)" onclick="window.location.replace('logout.php');"><button class="btn btn-danger">Logout</button></a>
                        <?php }  ?>
                    </div></div>
                    <?php if ((!isset($_SESSION['username'])) &&
                (!isset($_SESSION['username-admin']))) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">Master Panel</div>
                    <div class="panel-footer">
                        <a href="javascript:void(0)" onclick="window.location.replace('admin/master.php');"><button class="btn btn-warning">Master Login</button></a>
                    </div></div>
                <div class="panel panel-default">
                    <div class="panel-body">Features 3</div>
                    <div class="panel-footer"><p>The proper tracking of assets assures company and at the same time all interested parties, the entire vendor to public dealing with or affects the assets to track if any mismanagement, waste or mishandling.</p></div>
                </div>
                <?php } else { ?>
                    
                <?php } ?>
                </div> <!-- Panel group close. -->
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
<script type="text/javascript">
   var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>
</html>