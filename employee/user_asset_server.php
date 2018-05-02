<?php require '../server.php';
$admin = $_SESSION['username-admin'];
$error = "";
$temp_name = array();
if (isset($_POST['ua_submit'])) {
    $uid = mysqli_real_escape_string($db, $_POST['employee']);
    $exp = mysqli_real_escape_string($db, $_POST['expire']);
    $no_of_assets = count($_POST['arr']);

    $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$uid'") 
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $uname = $record['username'];
    
    for($i=0;$i<$no_of_assets;$i++) {
    $sql = "SELECT * FROM assets WHERE my_admin='$admin' and asset_id='".$_POST['arr'][$i]."'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        while ($row = mysqli_fetch_array($res)) {
                array_push($temp_name, $row['asset_name']);
        }
    }
    $error = "User: '".$uname."' is already assigned with:";
    for($i=0;$i<$no_of_assets;$i++) { 
        $sql = "SELECT * FROM junc WHERE junc_user='$user' and my_admin='$admin' and junc_asset='".$temp_name[$i]."'";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if (mysqli_num_rows($res) > 0) {
            $error .= "<br>- ".$temp_name[$i]." asset";
        }
        else {
            $error = "";
        }
    }
    

    $expArray = explode('/', $exp);
    $yymmdd = $expArray[2]."-".$expArray[0]."-".$expArray[1];
    $tareek = date('Y-m-d');

    if (!$error) {
        $sql = "INSERT INTO `junc` (`junc_user`,`junc_asset`, `received`, `expiry`, `my_admin`) VALUES ";
        for ($i=0; $i<count($temp_name) ; $i++) { 
            $sql .= "('".$uid."','".$temp_name[$i]."','".$tareek."','".$yymmdd."','".$admin."'),";
            $main_data .= " Asset-1: ".$temp_name[$i].";";
        }
        ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $rec = mysqli_query($db, "SELECT * FROM users WHERE user_ID='$uid'") or die(mysqli_error($db));
        $room = mysqli_fetch_array($rec);
        $temp_data = "Few Items were assign to user_id: ".$room['username'];
        $main_data = $temp_data.$main_data;
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
        $sql = rtrim($sql, ",");
        mysqli_query($db, $sql) or dir(mysqli_error($db));

        echo "<script type=\"text/javascript\">
                alert(\"Record Saved.\");
                window.location.assign(\"../index.php\");
            </script>";
    }
}
 ?>