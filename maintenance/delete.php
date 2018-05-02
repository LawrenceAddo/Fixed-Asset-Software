<?php require '../config.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $rec = mysqli_query($db, "SELECT * FROM `maintenance` WHERE `m_id`='$id'")
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $ast_nm = $record[1];
    $sql = "DELETE FROM `maintenance` WHERE `m_id`='$id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = "maintenance for asset = ".$ast_nm." has been deleted from database.";
        require_once '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"Maintenance record for asset: $ast_nm; has been deleted.\");
        window.location.assign(\"main_show.php\");
    </script>";
}
 ?>