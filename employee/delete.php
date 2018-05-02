<?php 
require_once '../config.php';

if (isset($_GET['delete'])) {
    $uid = $_GET['delete'];
    $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$uid'") 
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $uname = $record['username'];
    $sql = "DELETE FROM `users` WHERE `user_ID`='$uid'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $uname." user has been deleted from database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script>
        alert(\"$uname; has been deleted.\");
        window.location.assign(\"users_list.php\");
    </script>";
}