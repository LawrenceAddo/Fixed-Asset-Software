<?php include '../config.php';
require '../server.php';
$error = "";
if (isset($_POST['vendor_submit'])) {
    $vendor_name = mysqli_real_escape_string($db, $_POST['v_name']);
    $vendor_addr = mysqli_real_escape_string($db, $_POST['v_addr']);
    $pincode = mysqli_real_escape_string($db, $_POST['pin']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $mobile = mysqli_real_escape_string($db, $_POST['mob']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Invalid email format";
    }

    if (strlen($mobile) < 10) {
        $error .= "<br>Incorrect Mobile No.";
    }

    if (strlen($pincode) != 6) {
        $error .= "<br>Incorrect Pincode";
    }

    $sql = "SELECT * FROM vendor 
    WHERE vendor_name='$vendor_name' AND email='$email' 
    AND my_admin='".$_SESSION['username-admin']."'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($res) == 1) {
        $error = "Vendor already exists!";
    }

    if (!$error) {
        $admin = $_SESSION['username-admin'];
        $sql = "INSERT INTO `vendor`(`vendor_id`,`vendor_name`,`vendor_address`,`pincode`,`email`,`mobile`, `my_admin`) VALUES (NULL, '$vendor_name', '$vendor_addr', '$pincode', '$email', '$mobile', '$admin')";
        mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $vendor_name."; vendor has been added to the database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
        echo "<script type=\"text/javascript\">
                    alert(\"Record Saved.\");
                    window.location.assign(\"../index.php\");
            </script>";
    }
}
elseif (isset($_POST['vendor_edit_submit'])) {
    $vendor_name = mysqli_real_escape_string($db, $_POST['v_name']);
    $vendor_address = mysqli_real_escape_string($db, $_POST['v_addr']);
    $vendor_pincode = mysqli_real_escape_string($db, $_POST['pin']);
    $vendor_email = mysqli_real_escape_string($db, $_POST['email']);
    $vendor_mobile = mysqli_real_escape_string($db, $_POST['mob']);
    $current_vendor_id = mysqli_real_escape_string($db, $_POST['curr_v_id']);

    $sql = "UPDATE `vendor` SET `vendor_name`='$vendor_name',`vendor_address`='$vendor_address',`pincode`='$vendor_pincode',`email`='$vendor_email',`mobile`='$vendor_mobile' WHERE `vendor_id`='$current_vendor_id' AND `my_admin`='".$_SESSION['username-admin']."'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $vendor_name."; vendor credentials has been updated in database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script type=\"text/javascript\">
            alert(\"Record Updated.\");
            window.location.assign(\"view_vendor.php\");
    </script>";
}
?>