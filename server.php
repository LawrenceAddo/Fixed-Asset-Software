<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$error = "";
include 'config.php';
if (isset($_POST['register_submit'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $sname = mysqli_real_escape_string($db, $_POST['sname']);
    $user = mysqli_real_escape_string($db, $_POST['uname']);
    $loc = mysqli_real_escape_string($db, $_POST['off_loc']);
    # $pass_1 = mysqli_real_escape_string($db, $_POST['pass_1']);
    # $pass_2 = mysqli_real_escape_string($db, $_POST['pass_2']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>Invalid Email format"; 
    }

    if (strlen($mobile) != 10) {
        $error .= "<br>Invalid Mobile No.";
    }

    $sql = "SELECT username FROM users 
    WHERE username='$user' AND mobile='$mobile' AND my_admin='".$_SESSION['username-admin']."'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($res) > 0) {
        $error .= "<br>User already exists";
    }

    if (!$error) {
        $admin = $_SESSION['username-admin'];
        $sql_command = "INSERT INTO `users` (`fname`, `sname`, `username`, `email`, `mobile`, `fk_office_id`, `my_admin`)
        VALUES ('$fname', '$sname', '$user', '$email', '$mobile', '$loc', '$admin')";
        mysqli_query($db, $sql_command) or die(mysqli_error($db));
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $user." has been added to the database.";
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')"; 
        mysqli_query($db, $log_command) or die(mysqli_error($db));
        ############################### LOG SECTION END ########################
        echo "<script type=\"text/javascript\">
                alert(\"Registration Success.\");
                window.location.assign(\"../index.php\");
            </script>";
    }
}
elseif (isset($_POST['login_submit'])) {
    $username = mysqli_real_escape_string($db ,$_POST['user_name']);
    $password = mysqli_real_escape_string($db ,$_POST['pass_word']);
    
    $sql_query = "SELECT * FROM users WHERE username='$username' AND mobile='$password'";
    $result = mysqli_query($db, $sql_query) or die(mysqli_error($db));
    if (mysqli_num_rows($result) == 1) {
        $record = mysqli_fetch_array($result);
        $_SESSION['uid'] = $record[0];
        $_SESSION['username'] = $username;
        $x = $_SESSION['uid'];
        $y = $_SESSION['username'];
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $y." user has logged in.";
        $rec = mysqli_query($db, "SELECT * FROM `users` WHERE `user_ID`='$x'") or die(mysqli_error($db));
        $room = mysqli_fetch_array($rec);
        $admin = $room[7];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now', '$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
        ############################### LOG SECTION END ########################
        echo "<script type=\"text/javascript\">
                alert(\"Login Success. $x $y\");
                window.location.assign(\"index.php\");
            </script>";
    }
    elseif (mysqli_num_rows($result) == 0) {
        $sql = "SELECT * FROM admins WHERE admin_ID='$username' AND admin_password='$password'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));

        if (mysqli_num_rows($res) == 1) {
            $_SESSION['username-admin'] = $username;
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $_SESSION['username-admin']." admin has logged in.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')"; 
        mysqli_query($db, $log_command) or die(mysqli_error($db));
        ############################### LOG SECTION END ########################
            echo "<script type=\"text/javascript\">
                alert(\"Login Success.\");
                window.location.assign(\"index.php\");
            </script>";
        }
        if (mysqli_num_rows($res) != 1) {
            $error = "<br>Wrong Credentials..";
        }
    }
}

 ?>