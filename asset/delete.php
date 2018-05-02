<?php 
require_once '../config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "SELECT * FROM `assets` WHERE `asset_id`='$id'";
    $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $asset_name = $record['asset_name'];
    $sql = "DELETE FROM `assets` WHERE `asset_id`='$id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $asset_name."; has been deleted from database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"$asset_name; has been deleted.\");
        window.location.assign(\"view_asset.php\");
    </script>";
}
elseif (isset($_GET['delete_asset_category'])) {
    $id = $_GET['delete_asset_category'];
    $sql = "SELECT * FROM `asset_group` WHERE `asset_group_id`='$id'";
    $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $asset_name = $record['asset_group_name'];
    $sql = "DELETE FROM `asset_group` WHERE `asset_group_id`='$id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $asset_name."; asset category has been deleted from database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"$asset_name; has been deleted.\");
        window.location.assign(\"show_asset_category.php\");
    </script>";
}

 ?>