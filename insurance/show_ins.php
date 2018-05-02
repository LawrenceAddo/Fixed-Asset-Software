<?php include 'ins_server.php';
require '../server.php';
if (!isset($_SESSION['username-admin'])) {
    header("location: ../index.php");
} $admin = $_SESSION['username-admin'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>SHOW | INSURANCE</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .panel-heading, {
            padding: 2px;
        }
        .glyphicon {
            padding: 0;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
    <p class="h1" align="center">Insurance Data</p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-group">
                    <?php $sql="SELECT * FROM insurance WHERE myadmin='$admin'";
                    $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
                    if (mysqli_num_rows($rec) > 0) {
                    while ($row = mysqli_fetch_array($rec)) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <p style="font-weight: bolder; font-size: 15px;">Insurance record for Asset: <span style="color: black;">
                            <?php $sql = "SELECT * FROM assets WHERE asset_id='".$row[1]."'";
                            $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                            while ($record = mysqli_fetch_array($res)) {
                                echo $record['asset_name'];
                             } ?> <a class="btn btn-danger" href="delete.php?delete_ins=<?php echo($row[0]); ?>" style="float: right;">
                        <span class="glyphicon glyphicon-trash"></span>
                        </a>
                            </p>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Insurance Company</th>
                                        <th>Policy No.</th>
                                        <th>Issued For</th>
                                        <th>Cover Type</th>
                                        <th>Policy From</th>
                                        <th>Policy To</th>
                                        <th>Premium Amount</th>
                                        <th>Premium Deposit Interval (month)</th>
                                        <th>Next Premium Deposit Date</th>
                                        <!-- <th>Payment Mode</th>
                                        <th>Check or DD No.</th>
                                        <th>Check or DD Date</th>
                                        <th>Bank Name</th>
                                        <th>Insured Bank Name</th>
                                        <th>Account Number</th>
                                        <th>IFSC Code</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td>
                                        <?php $date1 = date('Y-m-d');
                                            $date2 = date($row[10]);
                                            if(strtotime($date1) > strtotime($date2)) {
                                          $newdate = strtotime ( '+'.$row[9] , strtotime ( $date2 )) ;
                                          $nxt_prm = $newdate;
                                          $room = mysqli_query($db, "UPDATE `insurance` SET `nxt_premium`='$nxt_prm' WHERE `ins_id`='".$row[0]."'") or die(mysqli_error($db));
                                            } ?>
                                        <td onload="document.location.reload(true);"><?php echo $row[10]; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>