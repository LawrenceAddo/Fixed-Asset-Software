<?php require '../server.php';
$admin = $_SESSION['username-admin'];
require '../config.php';
$error = "";
$temp_name = array();
if (isset($_POST['main_submit'])) {
    $cost = mysqli_real_escape_string($db, $_POST['m_cost']);
    $shop = mysqli_real_escape_string($db, $_POST['repair_shop']);
    $shop_addr = mysqli_real_escape_string($db, $_POST['repair_shop_addr']);
    $contact = mysqli_real_escape_string($db, $_POST['contact_no']);
    $tareek = mysqli_real_escape_string($db, $_POST['repair_date']);
    $ast_id = mysqli_real_escape_string($db, $_POST['ast_id']);
    
    $sql = "SELECT * FROM assets WHERE my_admin='$admin' and asset_id='$ast_id'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($res);
    $ast_nm = $record[2];
    $repair_tag = $record[1];
        
    if (!$error) {
        $expArray = explode('/', $tareek);
        $yymmdd = $expArray[2]."-".$expArray[0]."-".$expArray[1];
        $sql = "INSERT INTO `maintenance` (`asset_name`,`cost`,`shop_name`,`shop_address`,`contact`,`repair_date`, `my_admin`) VALUES ('$ast_nm', '$cost', '$shop', '$shop_addr', '$contact', '$yymmdd', '$admin')";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = "maintenance for asset = ".$ast_nm." @ ".$shop." - ".$shop_addr." - Contact: ".$contact." for Rs.".$cost." has been added to database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')"; 
        mysqli_query($db, $log_command) or die(mysqli_error($db));
        ############################### LOG SECTION END ########################
        $repair_tag = $repair_tag + 1;
        $sql = "UPDATE `assets` SET `repair_status`='$repair_tag' 
        WHERE my_admin='$admin' and asset_id='$ast_id'";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<script type=\"text/javascript\">
                alert(\"Record Saved.\");
                window.location.assign(\"../index.php\");
        </script>";
    }
}

 ?>