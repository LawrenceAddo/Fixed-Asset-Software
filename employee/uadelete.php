<?php 
require '../config.php';
if ((isset($_GET['uadelete'])) && (isset($_GET['asset']))) {
    $uid = $_GET['uadelete'];
    $asset = $_GET['asset'];
    $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$uid'") 
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $uname = $record['username'];
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $uname." with asset = ".$asset." has been deleted from database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    $sql = "DELETE FROM `junc` WHERE `junc_user`='$uid' and `junc_asset`='$asset'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    
    echo "<script>
        alert(\"$asset, held by $uname; has been deleted.\");
        window.location.assign(\"view_user_asset.php\");
    </script>";
}

 ?>