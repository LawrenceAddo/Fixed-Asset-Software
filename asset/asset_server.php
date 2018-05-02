<?php require '../server.php';
$admin = $_SESSION['username-admin'];
include '../config.php';
$error = "";
if (isset($_POST["asset_submit"])) {
  $fk_id = mysqli_real_escape_string($db, $_POST["asset_group_select"]);
  $asset_name = mysqli_real_escape_string($db, $_POST['add_asset_name']);
  $manu = mysqli_real_escape_string($db, $_POST['manu']);
  $model = mysqli_real_escape_string($db, $_POST['model']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $dep = mysqli_real_escape_string($db, $_POST['dep']);
  $purchase = mysqli_real_escape_string($db, $_POST['purchase']);
  $war = mysqli_real_escape_string($db, $_POST['war']);
  $vendor_id = mysqli_real_escape_string($db, $_POST["vendor_select"]);
####################################################################################
  $sql = "SELECT * FROM vendor WHERE my_admin='$admin' and vendor_id='".$vendor_id."'";
  $res = mysqli_query($db, $sql);
  $vendor_name = "";
  while ($row = mysqli_fetch_array($res)) {
      $vendor_name = $row['vendor_name'];
      //0k
  }
  $sql = "SELECT * FROM assets WHERE my_admin='$admin' and asset_name='".$asset_name."'";
  $res = mysqli_query($db, $sql) or die(mysqli_error($db));
  if (mysqli_num_rows($res) != 0) {
      $error = "Asset Name Already Exists!";
  }
######################################################################################
  if (!$error) {
    $expArray = explode('/', $purchase);
    $yymmdd_1 = $expArray[2]."-".$expArray[0]."-".$expArray[1];
    $expArray = explode('/', $war);
    $yymmdd_2 = $expArray[2]."-".$expArray[0]."-".$expArray[1];

    $sql = "INSERT INTO `assets` (`asset_id`, `asset_name`, `manufacturer`, `model`, `price`, `dep`, `purchase`, `warranty`, `vendor`, `fk_asset_group_id`, `my_admin`) VALUES (NULL, '$asset_name', '$manu', '$model', '$price',  '$dep', '$yymmdd_1', '$yymmdd_2', '$vendor_name', '$fk_id', '$admin')";

    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if ($res) {
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $asset_name."; asset has been added to database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
        echo "<script type=\"text/javascript\">
                  alert(\"Record Saved!\");
                  window.location.assign(\"../index.php\");
              </script>";
    }
  }     
}
elseif (isset($_POST['asset_define_submit'])) {
  # get the form data
  $fk_id = mysqli_real_escape_string($db, $_POST['asset_class_select']);
  $asset_grp = mysqli_real_escape_string($db, $_POST['add_asset_group']);

  # check for duplicate asset
  $sql = "SELECT * FROM asset_group WHERE my_admin='$admin' and asset_group_name='$asset_grp' and fk_asset_class_id='$fk_id'";
  $res = mysqli_query($db, $sql) or die(mysqli_error($db));
  if (mysqli_num_rows($res) > 0) {
    $error .= "<br>Asset Already Exists!";
  }

  # if no error so far, continue.
  if (!$error) {
    $sql = "INSERT INTO `asset_group` (`asset_group_id`, `asset_group_name`, `fk_asset_class_id`, `my_admin`) VALUES (NULL, '$asset_grp', '$fk_id', '$admin')";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $asset_grp."; has been added as an asset category to database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script type=\"text/javascript\">
            alert(\"Record Saved!\");
            window.location.assign(\"../index.php\");
          </script>";
    }
}
elseif (isset($_POST['asset_edit_submit'])) {
  # get the form data
  $asset_name = mysqli_real_escape_string($db, $_POST['add_asset_name']);
  $manu = mysqli_real_escape_string($db, $_POST['manu']);
  $model = mysqli_real_escape_string($db, $_POST['model']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $dep = mysqli_real_escape_string($db, $_POST['dep']);
  $purchase = mysqli_real_escape_string($db, $_POST['purchase']);
  $war = mysqli_real_escape_string($db, $_POST['war']);
  $vendor_id = mysqli_real_escape_string($db, $_POST["vendor_select"]);
  $curr_ast_id = mysqli_real_escape_string($db, $_POST["current_asset_id"]);

  # get vendor name by its id
  $sql = "SELECT * FROM vendor WHERE my_admin='$admin' and vendor_id='".$vendor_id."'";
  $res = mysqli_query($db, $sql);
  $vendor_name = "";
  if (mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_array($res);
    $vendor_name = $row['vendor_name'];
  }

  if (!$error) {
    # changing the date format.
    $expArray = explode('/', $purchase);
    $yymmdd_1 = $expArray[2]."-".$expArray[0]."-".$expArray[1];
    $expArray = explode('/', $war);
    $yymmdd_2 = $expArray[2]."-".$expArray[0]."-".$expArray[1];

    $yymmdd_1 = trim($yymmdd_1, "-");
    $yymmdd_2 = trim($yymmdd_2, "-");

    $sql = "UPDATE `assets` SET `asset_name`='$asset_name', `manufacturer`='$manu', `model`='$model', `price`='$price', `dep`='$dep', `purchase`='$yymmdd_1', `warranty`='$yymmdd_2', `vendor`='$vendor_name' WHERE `my_admin`='$admin' and `asset_id`='".$curr_ast_id."'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $asset_name." asset credentials has been updated in the database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script type=\"text/javascript\">
                alert(\"Record Updated!\");
                window.location.assign(\"view_asset.php\");
            </script>";
  }
}
 ?>