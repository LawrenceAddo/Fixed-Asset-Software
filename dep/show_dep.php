<?php require '../server.php';
if (!isset($_SESSION['username-admin'])) {
    header("location: ../index.php");
} $admin = $_SESSION['username-admin'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Depreciation</title>
<?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .table-striped > tbody > tr:nth-of-type(even) {
            background-color: white;
        }
        td, h1 {
            font-family: Oswald;
        }
        #yo1 {
            border-left: 10px solid tomato;
            height: auto;
            padding-left: 15px;
        }
        #yo2 {
            border-left: 10px solid lightgreen;
            height: auto;
            padding-left: 15px;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Asset Depreciation Values for Next 5 years.</h1>
            <div class="panel-group">
                <?php $sql = "SELECT * FROM assets WHERE my_admin='$admin'";
                $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_array($res)) { ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <?php $sql = "SELECT * FROM maintenance WHERE my_admin='$admin' and asset_name='".$row['asset_name']."'";
                            $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
                            $total_cost = 0;
                            $cost_arr = array();
                            $dating_arr = array();
                            for ($i=1; $i<=mysqli_num_rows($rec);$i++) { 
                                while($arr = mysqli_fetch_array($rec)) {
                                    $total_cost += $arr['cost'];
                                    array_push($cost_arr, $arr['cost']);
                                    array_push($dating_arr, $arr['repair_date']);
                                }

                            } ?>
                            <div id="yo1"><b style="color: #000;"><u>Maintenance</u>:</b><br>
                            <?php for ($i=0; $i<count($dating_arr) ; $i++) { 
                                echo "Cost: Rs.".$cost_arr[$i]." & Repair Date: ".$dating_arr[$i]."<br>";
                            }  echo "<strong>"."Total Cost: Rs.".$total_cost."<br><br>"; ?>
                            </strong></div>
                    <div id="yo2"><b style="color: #000;"><u>Asset Details</u>:</b><br><b>
                    <?php echo "Asset Name: ".$row['asset_name'].".<br> Price: Rs.".$row['price']."/-<br> Depreciation: ".$row['dep']."%<br> Purchased On: ".$row['purchase']; ?>
                    </b></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Year 1</th>
                                    <th>Year 2</th>
                                    <th>Year 3</th>
                                    <th>Year 4</th>
                                    <th>Year 5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                        <?php $cp = (float)$row['price'];
                              $dp = (float)$row['dep'];
                              $val = 0.000;
                              for ($i=1; $i<=5 ; $i++) { 
                                  $val = $cp - (($dp / 100) * $cp);
                                  $cp = $val;
                                  echo "<td>Rs. ".$val."</td>";
                              }
                        ?>
                            </tr>
                            </tbody>
                         </table>
                         </div>
                    </div>                 
                </div>
                <?php } } else { echo "<h4>No record found.</h4>"; } ?>
            </div>
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');"><button class="btn btn-info" style="margin-bottom: 10px;">Done</button></a>
            <br>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">

</script>
</html>