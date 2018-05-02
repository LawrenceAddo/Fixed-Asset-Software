<?php 
require_once '../admin/admin_server.php';
if (isset($_POST['chg_submit'])) {
    $old = mysqli_real_escape_string($db, $_POST['old_pass']);
    $new1 = mysqli_real_escape_string($db, $_POST['new_pass1']);
    $new2 = mysqli_real_escape_string($db, $_POST['new_pass2']);
    $mas_nam = $_SESSION['master'];
    if ($new1 != $new2) {
        $error = "Password Mismatch!";
    }

    $sql = "SELECT * FROM master WHERE `master_name`='$mas_nam' and `master_password`='$old'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($res) != 1) {
        $error = "Wrong Password!";
    }
    if ((mysqli_num_rows($res) == 1) && (!$error)) {
        $sql = "UPDATE `master` SET `master_password` = '$new1' 
        WHERE `master_name`='$mas_nam'";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<script type=\"text/javascript\">
                    alert(\"Password Updated.\");
                    window.location.assign(\"../admin/master_index.php\");
                </script>";
    }
}
 ?>