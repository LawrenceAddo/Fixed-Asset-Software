<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
}
$admin = $_SESSION['username-admin'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Data</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        td, h1 {
            font-family: Oswald;
        }
        table {
            background-color: white;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-body table-responsive">
                    <table class="table table-bordered" id="my_spl_table">
                        <thead>
                            <tr>
                                <td>SL No.</td>
                                <td width="60%">Log Data</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $count = 0;
                    $rec = mysqli_query($db, "SELECT * FROM log_file WHERE myadmin='$admin'") or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($rec)) { ?>
                             <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                            </tr>
                        <?php } ?>                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require '../footer.php'; ?>
</body>
</html>