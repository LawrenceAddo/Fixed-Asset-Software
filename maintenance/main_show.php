<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
?>
<?php require 'maintenance_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Record</title>
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
        <div class="col-sm-12" align="left">
            <h1 align="center">Maintenance Record(s)</h1>
            <?php $sql = "SELECT * FROM maintenance 
            WHERE my_admin='".$_SESSION['username-admin']."'";
                $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                $count = 1;
                if (mysqli_num_rows($result) <= 0) {
                    echo "<h4>No record found.</h4>";
                } else {
                    echo "
                    <div class=\"table-responsive\">
                    <table id=\"my_spl_table\" class=\"table table-striped\">
                    <thead>
                    <tr>
                    <th>SL No.</th>
                    <th>Asset Name</th>
                    <th>Cost (INR)</th>
                    <th>Shop/Store Name</th>
                    <th>Shop/Store Address</th>
                    <th>Contact</th>
                    <th>Dated at</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "
                        <tr>
                        <td>".$count."</td>
                        <td>".$row['asset_name']."</td>
                        <td>".$row['cost']."</td>
                        <td>".$row['shop_name']."</td>
                        <td>".$row['shop_address']."</td>
                        <td>".$row['contact']."</td>
                        <td>".$row['repair_date']."</td>
                        <td>"."
                        <a class=\"btn btn-danger\"
                        href=\"delete.php?delete=".$row['m_id']."\">
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
                    "; }
                 ?>
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">

</script>
</html> 