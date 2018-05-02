<?php include 'server.php';
if ($_SESSION) {
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        if (isset($_SESSION['username-admin'])) {
            $admin = $_SESSION['username-admin'];
            $main_data = $admin." logout success.";
            $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
            VALUES ('$main_data','$date_now','$admin')";
            mysqli_query($db, $log_command) or die(mysqli_error($db));
        }
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
            $sql = "SELECT * FROM users WHERE username='$user'";
            $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
            $room = mysqli_fetch_array($rec);
            $admin = $room[7];
            $main_data = $user." logout success.";
            $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
            VALUES ('$main_data','$date_now','$admin')";
            mysqli_query($db, $log_command) or die(mysqli_error($db));
        }
    ############################### LOG SECTION END ########################
    session_destroy();
    echo "<script type=\"text/javascript\">
                alert(\"Logout Success.\");
                window.location.assign(\"index.php\");
            </script>";
}
 ?>