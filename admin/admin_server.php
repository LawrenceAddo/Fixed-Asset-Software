<?php
include '../config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$error = "";
if (isset($_POST['admin_submit_reg'])) {
    $admin_id = mysqli_real_escape_string($db, $_POST['admin_id']);
    $password1 = mysqli_real_escape_string($db, $_POST['pass1']);
    $password2 = mysqli_real_escape_string($db, $_POST['pass2']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    if (strlen($admin_id) < 5) {
        $error = "Enter Admin-Username more than 5 characters.";
    }

    if ($password1 != $password2) {
        $error .= "<br>Password Mismatch";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>Invalid email format"; 
    }

    $sql = "SELECT * FROM admins WHERE admin_ID='$admin_id'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($res) > 0) {
        $error .= "<br>Admin already exists!";
    }

    if (!$error) {
        $sql = "INSERT INTO `admins`(`admin_ID`, `admin_password`, `admin_email`) VALUES ('$admin_id', '$password2', '$email')";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<script type=\"text/javascript\">
                alert(\"Record Saved.\");
                window.location.assign(\"master_index.php\");
            </script>";
    }
}
elseif (isset($_POST['master_login_submit'])) {
    $master_name = mysqli_real_escape_string($db, $_POST['master_name']);
    $master_pass = mysqli_real_escape_string($db, $_POST['master_pass']);

    $sql_query = "SELECT * FROM `master`
    WHERE `master_name`='$master_name' AND `master_password`='$master_pass'";
    $res = mysqli_query($db, $sql_query) or die(mysqli_error($db));
    # echo "Result: ".mysqli_num_rows($res);
    if (mysqli_num_rows($res) == 1) {
        $_SESSION['master'] = $master_name;
        echo "<script>alert(\"Login Success.\");</script>";
        header("location: master_index.php");
    }
    elseif (mysqli_num_rows($res) == 0) {
        $error .= "Worng Username or Password!";
    }
}
elseif (isset($_POST['master_submit_reg'])) {
    $name = mysqli_real_escape_string($db, $_POST['master_name']);
    $pass1 = mysqli_real_escape_string($db, $_POST['master_pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['master_pass2']);
    $email = mysqli_real_escape_string($db, $_POST['master_email']);

    if (strlen($name) < 5) {
        $error = "Enter Master-Username more than 5 characters.";
    }

    if ($pass1 != $pass2) {
        $error .= "<br>Password Mismatch";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>Invalid email format"; 
    }
    
    $sql = "SELECT * FROM master WHERE master_name='$name'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($res) > 0) {
        $error .= "<br>Master already exists!";
    }

    if (!$error) {
        $sql = "INSERT INTO `master`(`master_name`, `master_password`, `master_email`)
        VALUES ('$name', '$pass2', '$email')";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<script type=\"text/javascript\">
                alert(\"Record Saved.\");
                window.location.assign(\"master.php\");
            </script>";
    }
}
elseif (isset($_POST['admin_edit'])) {
    $admin_id = mysqli_real_escape_string($db, $_POST['admin_uname']);
    $admin_pass = mysqli_real_escape_string($db, $_POST['pass']);
    $admin_email = mysqli_real_escape_string($db, $_POST['email']);

    $sql = "UPDATE `admins` SET `admin_password`='$admin_pass',`admin_email`='$admin_email'
    WHERE `admin_ID`='$admin_id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    echo "<script type=\"text/javascript\">
            alert(\"Record Updated.\");
            window.location.assign(\"master_index.php\");
        </script>";
}
 ?>