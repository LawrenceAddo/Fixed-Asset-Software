<?php
include 'asset_server.php';
$ast_grp_name = "";
if (isset($_GET['edit'])) { 
    $id = $_GET['edit']; # asset_id

    $rec = mysqli_query($db, "SELECT * FROM assets WHERE asset_id=$id") or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $sub_res = mysqli_query($db,
        "SELECT * FROM asset_group WHERE asset_group_id='".$record[10]."'") or 
        die(mysqli_error($db));
        
    if (mysqli_num_rows($sub_res) == 1) {
        $row = mysqli_fetch_array($sub_res);
        $ast_grp_name = $row['asset_group_name']; # ast_grp_name
       
    }

    $asset_name = $record['asset_name']; # ast_name
    $manufac = $record['manufacturer']; # manufacturer
    $model = $record['model']; # model
    $price = $record['price']; # price
    $depre = $record['dep']; # depreciation
    $purchase = $record['purchase']; # purchase_date
    $yymmddArr = explode('-', $purchase);
    $mmddyy1 = $yymmddArr[1].'/'.$yymmddArr[2].'/'.$yymmddArr[0];
    $warranty = $record['warranty']; # warranty_date
    unset($yymmddArr);
    $yymmddArr = explode('-', $warranty);
    $mmddyy2 = $yymmddArr[1].'/'.$yymmddArr[2].'/'.$yymmddArr[0];

    $vendor_name = $record[8]; # vendor_name

    $sub_res = mysqli_query($db,
        "SELECT * FROM vendor WHERE vendor_name='".$record[8]."'") or 
        die(mysqli_error($db));
    if (mysqli_num_rows($sub_res) == 1) {
        $row = mysqli_fetch_array($sub_res);
        $vendor_id = $row['vendor_id']; # vendor_id
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Asset Edit</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .error {
            color: tomato;
        }
        h2 {
          margin-bottom: 0px;
          color: white;
          background: #5f68a0;
          border: 1px solid #B0C4DE;
          border-bottom: none;
          border-radius: 10px 10px 0px 0px;
          padding: 20px;
          font-size: 25px;
        }
        form {
          margin: 0px auto 10px auto;
          padding: 20px;
          border: 1px solid #B0C4DE;
          background: #F8F8FF;
          border-radius: 0px 0px 10px 10px;
        }
    </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h2 class="text-center">Edit Assets<br>
            <small class="text-muted" style="color: lightgray;">
            You can't edit the asset category</small>
        </h2>
        <form method="post" action="edit.php">
                <div class="error"><?php include '../error.php'; ?></div>
                <input type="hidden" name="current_asset_id"
                value="<?php echo $id; ?>">
                <label>Asset Group:</label>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="<?php echo $ast_grp_name; ?>" disabled>
                </div>
                <label>Assset Name:</label>
                <div class="form-group">
                    <input type="text" name="add_asset_name" class="form-control" placeholder="Asset Name" required="True"
                    value="<?php echo $asset_name; ?>">
                </div>
                <label>Manufacturer:</label>
                <div class="form-group">
                    <input type="text" name="manu" class="form-control" placeholder="
                    Manufacturer" required="True"
                    value="<?php echo $manufac; ?>">
                </div>
                <label>Model No.</label>
                <div class="form-group">
                    <input type="text" name="model" class="form-control" placeholder="Model No." required="True"
                    value="<?php echo $model; ?>">
                </div>
                <label>Vendor:</label>
                <div class="form-group">
                    <select name="vendor_select" class="form-control" id="vendor_select" required="True">
                      <option value="<?php echo $vendor_id; ?>">
                        <?php echo $vendor_name; ?></option>
                        <option value="">-------------------</option>
                      <?php $sql="SELECT * FROM vendor where my_admin='".$_SESSION['username-admin']."'";
                            $result=mysqli_query($db, $sql) or die(mysqli_error());
                            if ($result) {
                                 while ($row = mysqli_fetch_array($result)) {
                                    if ($row['vendor_name'] != $vendor_name) {
                                        echo "<option value=".$row["vendor_id"].">".$row["vendor_name"]."</option>";
                                    }
                                }
                            } ?>
                    </select>
                </div>
                <label>Cost Price (in Rs.):</label>
                <div class="form-group">
                    <input type="text" name="price" class="form-control" placeholder="Price INR" required="True"
                    value="<?php echo $price; ?>">
                </div>
                <label>Depreciation (in %):</label>
                <div class="form-group">
                    <input type="text" name="dep" class="form-control" placeholder="Depreciation %" required="True"
                    value="<?php echo $depre; ?>">
                </div>
                <label>Date of Purchase:</label>
                <div class="form-group">
                    <input type="text" name="purchase" class="form-control" id="datepicker1" placeholder="Purchase Date" required="True"
                    value="<?php echo $mmddyy1; ?>">
                </div>
                <label>Warranty Date (upto):</label>
                <div class="form-group">
                    <input type="text" name="war" class="form-control" id="datepicker2" placeholder="Warranty Upto" required="True"
                    value="<?php echo $mmddyy2; ?>">
                </div>
                <input type="submit" class="btn btn-success" name="asset_edit_submit" value="Update">
                <a href="view_asset.php">Cancel</a>
            </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">
        // DATE PICKER - jQuery
          $( "#datepicker1" ).datepicker({
          });

        $( function() {
          $( "#datepicker2" ).datepicker();
        });
        
</script>
</html>