<?php include '../config.php';
require '../server.php';
$admin = $_SESSION['username-admin'];
$error = "";
if (isset($_POST['off_submit'])) {
    $office_type = mysqli_real_escape_string($db, $_POST['off_type']);
    $office_name = mysqli_real_escape_string($db, $_POST['off_name']);
    $office_address = $_POST['addr'][0].", ".$_POST['addr'][1]." - ".$_POST['addr'][2].", ".$_POST['addr'][3].".";
    if ($office_type == 1) {
        $sql = "SELECT * FROM office 
        WHERE fk_office_type_id='1' AND my_admin='".$_SESSION['username-admin']."'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($res) == 1) {
            $error = "<br>Head Office Already Exists!";
        }
    }
    
    if (!$error) {
        
        $sql = "INSERT INTO `office` (`office_name`,`office_address`, `fk_office_type_id`, `my_admin`) VALUES ('$office_name', '$office_address', '$office_type', '$admin')";
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $office_name."; office has been added to database.";
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO log_file (log_data,log_date,myadmin)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
        mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<script type=\"text/javascript\">
                    alert(\"Record Saved.\");
                    window.location.assign(\"../index.php\");
                </script>";
    }
}
elseif (isset($_POST['off_edit_submit'])) {
    
    $office_name = mysqli_real_escape_string($db, $_POST['off_name']);
    $office_adr = mysqli_real_escape_string($db, $_POST['off_addr']);
    $curr_off_id = mysqli_real_escape_string($db, $_POST["curr_office_id"]);

    $sql = "UPDATE `office` SET `office_name`='$office_name', `office_address`='$office_adr' 
    WHERE `office_id`='$curr_off_id' AND `my_admin`='$admin'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $main_data = $office_name."; credentials has been updated in database.";
        require '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script type=\"text/javascript\">
            alert(\"Record Updated.\");
            window.location.assign(\"view_offices.php\");
        </script>";
}
 ?>