<?php include '../config.php';
require '../server.php';
$admin = $_SESSION['username-admin'];
$error = "";
if (isset($_POST['user_edit_submit'])) {
    $curr_uid = mysqli_real_escape_string($db, $_POST['uid']);
    $first_name = mysqli_real_escape_string($db, $_POST['fname']);
    $last_name = mysqli_real_escape_string($db, $_POST['sname']);
    $office_locatn = mysqli_real_escape_string($db, $_POST['off_loc']);
    $email_ID = mysqli_real_escape_string($db, $_POST['email']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    # $password = mysqli_real_escape_string($db, $_POST['pass']);
    if (!filter_var($email_ID, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>Invalid email format"; 
    }

    if (!$error) {
        $sql_command = "UPDATE `users` SET `fname`='$first_name', `sname`='$last_name', `email`='$email_ID', `mobile`='$mobile' 
        WHERE `my_admin`='$admin' and `user_ID`='$curr_uid'";
        mysqli_query($db, $sql_command) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$curr_uid'") or die(mysqli_error($db));
        $record = mysqli_fetch_array($rec);
        $main_data = $record[3]." credentials has been updated in database.";
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
        echo "<script type=\"text/javascript\">
                alert(\"Record Updated.\");
                window.location.assign(\"users_list.php\");
            </script>";
    }

}
?>
