<?php 
require_once '../config.php';

if (isset($_GET['delete_ins'])) {
    $id = $_GET['delete_ins'];
    $sql = "DELETE FROM `insurance` WHERE `ins_id`='$id'";
    $r = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($r);
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $rec = mysqli_query($db, "SELECT * FROM `assets` WHERE asset_id='".$record[1]."'") or die(mysqli_error($db));
        $room = mysqli_fetch_array($rec);
        $ast_nm = $room[2];
        $main_data = "insurance for asset = ".$ast_nm." has been deleted from database.";
        require_once '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"Deletion Successful.\");
        window.location.assign(\"show_ins.php\");
    </script>";
}

?>