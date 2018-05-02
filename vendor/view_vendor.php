<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'vendor_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Vendors</title>
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
            <h2 align="center">Registered Vendors</h2>
            <?php $sql = "SELECT * FROM vendor 
            WHERE my_admin='".$_SESSION['username-admin']."'";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            if (mysqli_num_rows($result) <= 0) {
                echo "<h4>No record found.</h4>";
            }
                echo "
                <div class=\"table-responsive\">
                <table id=\"my_spl_table\" class=\"table table-striped\">
                <thead>
                <tr>
                <th>Vendor</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Email ID</th>
                <th>Mobile</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = mysqli_fetch_array($result)) { 
                    echo "
                    <tr>
                    <td>".$row['vendor_name']."</td>
                    <td>".$row['vendor_address']."</td>
                    <td>".$row['pincode']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['mobile']."</td>
                    <td>"."
                        <a class=\"btn btn-primary\"
                        href=\"edit.php?edit=".$row['vendor_id']."\">
                        <span class=\"glyphicon glyphicon-edit\"></span>
                        </a>
                        <a class=\"btn btn-danger\"
                        href=\"delete.php?delete=".$row['vendor_id']."\">
                        <span class=\"glyphicon glyphicon-trash\"></span>
                        </a>
                    "."</td>
                    </tr>
                    ";
                }
                echo "
                </tbody>
                </table>
                </div>
                ";
            ?>
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>