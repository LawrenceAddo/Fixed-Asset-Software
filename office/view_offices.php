<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'office_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Location</title>
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
            <h2 align="center">Office Locations</h2>
            <?php 
            include '../config.php';
            $sql = "SELECT * FROM office WHERE my_admin='".$_SESSION['username-admin']."'";
            $count = 1;
            $result = mysqli_query($db, $sql) or die(mysqli_error());
            if (mysqli_num_rows($result) <= 0) {
                echo "<h4>No record found.</h4>";
            } else {
                echo "
                <div class=\"table-responsive\">
                <table id=\"my_spl_table\" class=\"table table-striped\">
                <thead>
                <tr>
                <th>SL. No</th>
                <th>Office Type</th>
                <th>Office Name</th>
                <th>Office Address</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = mysqli_fetch_array($result)) { 
                    $sub_sql = "SELECT * FROM office_type 
                    WHERE office_id='".$row['fk_office_type_id']."'";
                    $res = mysqli_query($db, $sub_sql) or die(mysqli_error());
                    $off_type = "";
                    foreach ($res as $key) {
                        $off_type = $key['office_type'];
                    }
                    echo "
                    <tr>
                    <td>".$count."</td>
                    <td>".$off_type."</td>
                    <td>".$row['office_name']."</td>
                    <td>".$row['office_address']."</td>
                    <td>"."
                    <a class=\"btn btn-primary\"
                    href=\"edit.php?edit=".$row['office_id']."\">
                    <span class=\"glyphicon glyphicon-edit\"></span>
                    </a>
                    <a class=\"btn btn-danger\"
                    href=\"delete.php?delete=".$row['office_id']."\">
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
            <a href="../index.php"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">

</script>
</html>