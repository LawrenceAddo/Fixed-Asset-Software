<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
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
            <h1 align="center">Registered Users</h1>
            <?php $sql = "SELECT * FROM users WHERE my_admin='".$_SESSION['username-admin']."'";
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Location</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
                    while ($row = mysqli_fetch_array($result)) {
                        $q = mysqli_query($db, "SELECT * from office where office_id='".$row['fk_office_id']."'") or die(mysqli_error($db));
                        $record = mysqli_fetch_array($q);
                        echo "
                        <tr>
                        <td>".$count."</td>
                        <td>".$row['fname']."</td>
                        <td>".$row['sname']."</td>
                        <td>".$row['username']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['mobile']."</td>
                        <td>".$record[2]."</td>
                        <td>"."
                        <a class=\"btn btn-primary\"
                        href=\"edit.php?edit=".$row['user_ID']."\">
                        <span class=\"glyphicon glyphicon-edit\"></span>
                        </a>
                        <a class=\"btn btn-danger\"
                        href=\"delete.php?delete=".$row['user_ID']."\">
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