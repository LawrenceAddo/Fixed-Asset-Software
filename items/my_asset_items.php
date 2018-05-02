<?php
include '../server.php';
$sql = "SELECT * FROM `junc` WHERE `junc_user`='".$_SESSION['uid']."'";
$res = mysqli_query($db, $sql) or die (mysqli_error($db));
$count = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_SESSION['username']; ?> | Assets</title>
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
<h1 align="center">Asset Records of <?php echo $_SESSION['username']; ?>.</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-12" align="left">
            <div class="table-responsive">
            <table id="my_spl_table" class="table table-striped">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Asset Name</th>
                        <th>Receive Date</th>
                        <th>Return Date</th>
                        <th>Report to Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($res)) { ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td>
                            <a class="btn btn-primary btn-md" href="report.php?report_for=<?php echo($row[0]); ?>">
                            <span class="glyphicon glyphicon-exclamation-sign"></span> Report to the admin
                            </a>
                            </td>
                        </tr>
                    <?php $count = $count + 1; } ?>
                </tbody>
            </table></div>
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>