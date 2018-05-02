<?php 
require '../config.php';
$error = "";
$user_admin = "";
if (isset($_SESSION['username'])) {
    header("location: ../index.php");
}

if (isset($_SESSION['username-admin'])) {
    $user_admin = $_SESSION['username-admin'];
}

if (isset($_POST['chg_submit'])) {
    if ($user_admin) {
        $old = mysqli_real_escape_string($db, $_POST['old_pass']);
        $new1 = mysqli_real_escape_string($db, $_POST['new_pass1']);
        $new2 = mysqli_real_escape_string($db, $_POST['new_pass2']);

        if ($new1 != $new2) {
            $error = "Password Mismatch!";
        }

        $sql = "SELECT * FROM admins WHERE admin_ID='$user_admin' and admin_password='$old'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($res) != 1) {
            $error = "Wrong Password!";
        }
        if ((mysqli_num_rows($res) == 1) && (!$error)) {
            $sql = "UPDATE `admins` SET `admin_password` = '$new1' 
            WHERE `admin_ID`='$user_admin'";
            mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $user_admin." has updated it's password in database.";
        require '../server.php';
        $admin = $user_admin;
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
            echo "<script type=\"text/javascript\">
                        alert(\"Password Updated.\");
                        window.location.assign(\"../index.php\");
                    </script>";
        }
    }
}
 ?>