<?php 
require_once '../config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "SELECT * FROM `office` WHERE `office_id`='$id'";
    $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $office_name = $record['office_name'];
    $sql = "DELETE FROM `office` WHERE `office_id`='$id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $office_name."; office has been deleted from database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"$office_name; has been deleted.\");
        window.location.assign(\"view_offices.php\");
    </script>";
}

?>