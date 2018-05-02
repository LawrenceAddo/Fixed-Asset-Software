<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'asset_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Asset Display</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .table-striped > tbody > tr:nth-of-type(even) {
            background-color: white;
        }
        td, h1 {
            font-family: Oswald;
        }
        .btn-primary, .btn-danger {
            padding: 3px !important;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Asset Records</h1>
            <?php $sql = "SELECT * FROM assets where my_admin='".$_SESSION['username-admin']."'";
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
                <th>SL. No</th>
                <th>Asset Group</th>
                <th>Asset Name</th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Vendor</th>
                <th>Price</th>
                <th>Depreciation</th>
                <th>Purchase Date</th>
                <th>Warranty Date</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = mysqli_fetch_array($result)) { 
                    $sub_sql = "SELECT * FROM asset_group 
                    WHERE asset_group_id='".$row['fk_asset_group_id']."'";
                    $res = mysqli_query($db, $sub_sql) or die(mysqli_error($db));
                    $group_name = "";
                    foreach ($res as $key) {
                        $group_name = $key['asset_group_name'];
                    }
                    echo "
                    <tr>
                    <td>".$count."</td>
                    <td>".$group_name."</td>
                    <td>".$row['asset_name']."</td>
                    <td>".$row['manufacturer']."</td>
                    <td>".$row['model']."</td>
                    <td>".$row['vendor']."</td>
                    <td>".$row['price']."</td>
                    <td>".$row['dep']."%</td>
                    <td>".$row['purchase']."</td>
                    <td>".$row['warranty']."</td>
                    <td>"."
                    <a class=\"btn btn-primary\"
                    href=\"edit.php?edit=".$row['asset_id']."\">
                    <span class=\"glyphicon glyphicon-edit\"></span>
                    </a>
                    <a class=\"btn btn-danger\"
                    href=\"delete.php?delete=".$row['asset_id']."\">
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