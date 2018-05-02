<?php include 'admin_server.php';
if (!isset($_SESSION['master'])) {
        header("location: master.php");
}
$tareek = date('d-m-Y');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Master | Dashboard</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .table-striped > tbody > tr:nth-of-type(even) {
            background-color: white;
        }
        td, h1 {
            font-family: Oswald;
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 align="center">Registered Admins</h1>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sql = "SELECT * FROM `admins`";
                        $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row['admin_ID']; ?></td>
                            <td><?php echo $row['admin_password']; ?></td>
                            <td><?php echo $row['admin_email']; ?></td>
                            <td>
                                <?php echo "<a class=\"btn btn-primary\"
                        href=\"edit.php?edit=".$row['admin_ID']."\">
                        <span class=\"glyphicon glyphicon-edit\"></span>
                        </a>
                        <a class=\"btn btn-danger\"
                        href=\"delete.php?delete=".$row['admin_ID']."\">
                        <span class=\"glyphicon glyphicon-trash\"></span>
                        </a>"; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <a href="javascript:void(0)" onclick="window.location.replace('admin_register.php');"><button class="btn btn-info">Add Admin</button></a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
                <div class="panel panel-warning">
                    <div class="panel-body">
                        <h4><?php echo "Date: ".$tareek; ?>
                            <div id="samay"></div>
                        </h4>
                    </div>
                    <div class="panel-footer" style="background-color: white;">
                        <a href="javascript:void(0)" onclick="window.location.replace('../logout.php');"><button class="btn btn-danger">Logout</button></a>
                        <a href="javascript:void(0)" onclick="window.location.replace('../password_manager/change_password.php');"><button class="btn btn-warning">Change Password</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../footer.php'; ?>
</body>
</html>