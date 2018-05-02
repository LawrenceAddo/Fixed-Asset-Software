<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
    header("location: ../index.php");
}
$admin = $_SESSION['username-admin']; ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        h2, td {
            font-family: Oswald;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 align="center">User(s) Asset(s)</h2>
            <?php $sql = "SELECT DISTINCT `junc_user` FROM `junc` WHERE my_admin='$admin'";
            $temp_user = array();
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            if (mysqli_num_rows($result) > 0) {
                while ($each = mysqli_fetch_array($result)) {
                    array_push($temp_user, $each['junc_user']);
                }
            } ?>
            <div class="panel-group">
            <?php foreach ($temp_user as $key => $value) { ?>
            <div class="panel panel-info">
                <div class="panel-heading">UserName: <b style="color: #000;">
                <?php 
                $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$value'") 
                or die(mysqli_error($db));
                $record = mysqli_fetch_array($rec);
                $uname = $record['username'];
                echo $uname; ?></b>
                <?php $q_one = "SELECT * from `users` WHERE `user_ID`='$value'"; 
                $rec_one = mysqli_query($db, $q_one) or die(mysqli_error($db));
                $record_one = mysqli_fetch_array($rec_one);
                $q_two = "SELECT * from `office` 
                WHERE `office_id`='".$record_one['fk_office_id']."'"; # get office from user table
                $rec_two = mysqli_query($db, $q_two) or die(mysqli_error($db));
                $record_two = mysqli_fetch_array($rec_two);
                $q_three = "SELECT * FROM `office_type` WHERE `office_id`='".$record_two[3]."'";
                $rec_three = mysqli_query($db, $q_three) or die(mysqli_error($db));
                $record_three = mysqli_fetch_array($rec_three);
                $o_name = $record_two[1].", ".$record_two[2];
                $o_type = $record_three[1];
                ?><br>
                Location: <b style="color: #000;"><?php echo $o_type." - ".$o_name; ?> </b>
                </div>
                <?php    
                    $sql = "SELECT * FROM junc 
                    WHERE my_admin='$admin' and junc_user='".$value."'";
                    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                    if (mysqli_num_rows($result) > 0) { ?>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Assets:</th>
                                <th>Assigned:</th>
                                <th>Expiry:</th>
                                <th>Action:</th>
                            </tr>
                        </thead>
                    <?php while ($each = mysqli_fetch_array($result)) { 
                    echo "
                    <tbody>
                    <tr>
                    <td>".$each['junc_asset']."</td>
                    <td>".$each['received']."</td>
                    <td>".$each['expiry']."</td>
                    <td>"."
                    <a class=\"btn btn-danger\"
                    href=\"uadelete.php?uadelete=".$value."&asset=".$each['junc_asset']."\">
                    <span class=\"glyphicon glyphicon-trash\"></span>
                    </a>
                    "."</td>
                    </tr>
                    ";
                    } echo "</tbody>"; ?>
                    </table>
                    </div>
                </div>
            </div>
                <?php } } ?>
            </div>
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>