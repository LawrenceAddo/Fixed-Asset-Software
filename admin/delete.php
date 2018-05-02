<?php 
require_once '../config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "SELECT * FROM `admins` WHERE `admin_ID`='$id'";
    $rec = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $admin_user_name = $record['admin_ID'];
    $sql = "DELETE FROM `admins` WHERE `admin_ID`='$id'";
    mysqli_query($db, $sql) or die(mysqli_error($db));
    echo "<script>
        alert(\"$admin_user_name; has been deleted.\");
        window.location.assign(\"master_index.php\");
    </script>";
}
?>