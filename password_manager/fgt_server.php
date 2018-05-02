<?php 
include '../config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$error = "";
if (isset($_POST['fgt_submit'])) {
    $old_password = mysqli_real_escape_string($db, $_POST['old_pass']);
    $old_name = mysqli_real_escape_string($db, $_POST['old_name']);
    $old_email = mysqli_real_escape_string($db, $_POST['old_email']);

    if (strlen($old_name) < 5) {
        $error = "Enter Username more than 5 characters.";
    }

    if (!filter_var($old_email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>- Invalid email format"; 
    }

    if (!$error) {
        $sql = "SELECT * FROM admins
        WHERE admin_ID='$old_name' and admin_password='$old_password'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($res) == 1) {
            echo "<script type=\"text/javascript\">
                alert(\"Dear, ".$old_name." the Last Password you entered is correct!\");
                window.location.assign(\"../index.php\");
            </script>";
            exit();
        }

        $sql = "SELECT * FROM master
        WHERE master_name='$old_name' and master_password='$old_password'";
        if ($res) {
            if (mysqli_num_rows($res) == 1) {
                echo "<script type=\"text/javascript\">
                    alert(\"Dear, ".$old_name." the Last Password you entered is correct!\");
                    window.location.assign(\"../index.php\");
                </script>";
                exit();
            }
        }

        $sql = "SELECT * FROM admins WHERE admin_ID='$old_name' and admin_email='$old_email'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if ($res) {
            if (mysqli_num_rows($res) == 1) {
                $_SESSION['reset'] = "Reset Your Password";
                $_SESSION['utype'] = "admin";
                $_SESSION['uname'] = $old_name;
                header("location: forgot_password.php");
                exit();
            }else { $error = "<br>Wrong Username or Email"; }
        }

        $sql = "SELECT * FROM master 
        WHERE master_name='$old_name' and master_email='$old_email'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if ($res) {
            if (mysqli_num_rows($res) == 1) {
                $_SESSION['reset'] = "Reset Your Password";
                $_SESSION['utype'] = "master";
                $_SESSION['uname'] = $old_name;
                header("location: forgot_password.php");
                exit();
            } else { $error = "<br>Wrong Username or Email"; }
        }
    }
}
elseif (isset($_POST['rst_submit'])) {
    $user_type = mysqli_real_escape_string($db, $_POST['user_type']);
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $pass1 =  mysqli_real_escape_string($db, $_POST['new_pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['new_pass2']);

    if ($pass2 != $pass1) {
        $error = "Password Mismatch";
    }

    if (!$error) {
        if ($user_type == 'admin') {
            $sql = "UPDATE `admins` SET `admin_password`='$pass1' 
            WHERE `admin_ID`='$user_id'";
            mysqli_query($db, $sql) or die(mysqli_error($db));
            unset($_SESSION['reset']);
            unset($_SESSION['utype']);
            unset($_SESSION['uname']);
            echo "<script>alert(\"Password Updated.\");</script>";
            header("location: ../index.php");
        }
        elseif ($user_type == 'master') {
            $sql = "UPDATE `master` SET `master_password`='$pass2' 
            WHERE `master_name`='$user_id'";
            mysqli_query($db, $sql) or die(mysqli_error($db));
            unset($_SESSION['reset']);
            unset($_SESSION['utype']);
            unset($_SESSION['uname']);
            echo "<script>alert(\"Password Updated.\");</script>";
            header("location: ../index.php");
        }
    }

}

 ?>

