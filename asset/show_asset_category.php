<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'asset_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Asset Categories</title> 
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
</head>
<body>
<?php include '../tools.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 align="center">Asset Category Records</h1>
                <?php 
                include '../config.php';
                $sql = "SELECT * FROM asset_group where my_admin='".$_SESSION['username-admin']."'";
                $count = 1;
                $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) <= 0) {
                    echo "<h4>No record found.</h4>";
                }
                else {
                    echo "
                    <div class=\"table-responsive\">
                    <table id=\"my_spl_table\" class=\"table table-striped\">
                    <thead>
                    <tr>
                    <th>SL No.</th>
                    <th>Asset Type</th>
                    <th>Asset Class</th>
                    <th>Asset Category</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
                    while ($row = mysqli_fetch_array($result)) {
                        $sub_sql = "SELECT * FROM asset_class 
                        WHERE asset_class_id='".$row['fk_asset_class_id']."'";
                        $res = mysqli_query($db, $sub_sql) or die(mysqli_error($db));
                        $class_name = "";
                        $type_name = "";
                        $fk_asset_type_id = "";
                        foreach ($res as $key) {
                            $class_name = $key['asset_class_name'];
                            $fk_asset_type_id = $key['fk_asset_type_id'];
                        }
                        
                        $sub_sql = "SELECT * FROM asset_type 
                        WHERE asset_type_id='".$fk_asset_type_id."'";
                        $res = mysqli_query($db, $sub_sql) or die(mysqli_error($db));
                        foreach ($res as $key) {
                            $type_name = $key['asset_type_name'];
                        }
                        
                        echo "
                        <tr>
                        <td>".$count."</td>
                        <td>".$type_name."</td>
                        <td>".$class_name."</td>
                        <td>".$row['asset_group_name']."</td>
                        <td>"."
                        <a class=\"btn btn-danger\"
                        href=\"delete.php?delete_asset_category=".$row['asset_group_id']."\">
                        <span class=\"glyphicon glyphicon-trash\"></span>
                        </a>
                        "."</td>
                        </tr>
                        ";
                        $count = $count + 1;
                    }
                    echo "
                    </tbody>
                    </table>
                    </div>
                    ";
                }
                 ?>
                <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
            </div>
        </div>
    </div>
    <?php require '../footer.php'; ?>
</body>
</html>