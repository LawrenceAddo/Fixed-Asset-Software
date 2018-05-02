<?php include '../config.php';

if (isset($_POST['ins_sub'])) {
    $admin = $_POST['admin'];
    $asset_id = mysqli_real_escape_string($db, $_POST["asset_item"]);
    $ins_company = mysqli_real_escape_string($db, $_POST["ins_company"]);
    $ins_registration_no = mysqli_real_escape_string($db, $_POST["ins_registration_no"]);
    $issued_for = mysqli_real_escape_string($db, $_POST["issued_for"]);
    $type_of_cover = mysqli_real_escape_string($db, $_POST["type_of_cover"]);
    $policy_from = mysqli_real_escape_string($db, $_POST["policy_from"]);
    $policy_to = mysqli_real_escape_string($db, $_POST["policy_to"]);
    # $financer = mysqli_real_escape_string($db, $_POST["financer"]);
    # $financer_details = mysqli_real_escape_string($db, $_POST["financer_details"]);
    $premium_amt = mysqli_real_escape_string($db, $_POST["premium_amt"]);
    $premium_period = mysqli_real_escape_string($db, $_POST["premium_period"]);
    # $payment_mode = mysqli_real_escape_string($db, $_POST["payment_mode"]);
    # $ch_or_dd_no = mysqli_real_escape_string($db, $_POST["ch_or_dd_no"]);
    # $ch_or_dd_date = mysqli_real_escape_string($db, $_POST["ch_or_dd_date"]);
    # $bank_name = mysqli_real_escape_string($db, $_POST["bank_name"]);
    # $insured_bank = mysqli_real_escape_string($db, $_POST["insured_bank"]);
    # $acc_no = mysqli_real_escape_string($db, $_POST["acc_no"]);
    # $ifsc = mysqli_real_escape_string($db, $_POST["ifsc"]);

    $expArray = explode('/', $policy_from);
    $policy_from = $expArray[2]."-".$expArray[0]."-".$expArray[1];

    $expArray = explode('/', $policy_to);
    $policy_to = $expArray[2]."-".$expArray[0]."-".$expArray[1];

    # $expArray = explode('/', $ch_or_dd_date);
    # $ch_or_dd_date = $expArray[2]."-".$expArray[0]."-".$expArray[1];

    $date = date($policy_from);
    $newdate = strtotime ( '+'.$premium_period , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m-j' , $newdate );
    $nxt_premium = $newdate;
/*
    echo $admin;
    echo $asset_id;
    echo $ins_company;
    echo $ins_registration_no;
    echo $issued_for;
    echo $type_of_cover;
    echo $policy_from;
    echo $policy_to;
    echo $financer;
    echo $financer_details;
    echo $premium_amt;
    echo $premium_period;
    echo $payment_mode;
    echo $ch_or_dd_no;
    echo $ch_or_dd_date;
    echo $bank_name;
    echo $insured_bank;
    echo $acc_no;
    echo $ifsc;
    echo $nxt_premium;

    $sql = "INSERT INTO `insurance` (`myadmin`,`ast_id`,`ins_com`,`ins_reg_no`,`issued_for`,`type_of_cover`,`policy_from`,`policy_to`,`financer`,`financer_details`,`premium_amt`,`premium_period`,`payment_mode`,`ch_or_dd_no`,`ch_or_dd_date`,`bank_name`,`insured_bank`,`acc_no`,`ifsc`,`nxt_premium`) VALUES ('$admin','$asset_id','$ins_company','$ins_registration_no','$issued_for','$type_of_cover','$policy_from','$policy_to','$financer','$financer_details','$premium_amt','$premium_period','$payment_mode','$ch_or_dd_no','$ch_or_dd_date','$bank_name','$insured_bank','$acc_no','$ifsc','$nxt_premium')";

*/

    $sql = "INSERT INTO `insurance` (`myadmin`,`ast_id`,`ins_com`,`ins_reg_no`,`issued_for`,`type_of_cover`,`policy_from`,`policy_to`,`premium_amt`,`premium_period`,`nxt_premium`) VALUES ('$admin','$asset_id','$ins_company','$ins_registration_no','$issued_for','$type_of_cover','$policy_from','$policy_to','$premium_amt','$premium_period','$nxt_premium')";
    
    mysqli_query($db, $sql) or die(mysqli_error($db));
    ################################ LOG SECTION ########################
        $date_now = date('Y-m-d');
        $rec = mysqli_query($db, "SELECT * FROM `assets` WHERE asset_id='$asset_id'") or die(mysqli_error($db));
        $room = mysqli_fetch_array($rec);
        $ast_nm = $room[2];
        $main_data = "insurance for asset = ".$ast_nm." has been added to database.";
        require_once '../server.php';
        $admin = $_SESSION['username-admin'];
        $log_command = "INSERT INTO `log_file` (`log_data`,`log_date`,`myadmin`)
        VALUES ('$main_data','$date_now','$admin')";
        mysqli_query($db, $log_command) or die(mysqli_error($db));
    ############################### LOG SECTION END ########################
    echo "<script type=\"text/javascript\">
              alert(\"Record Saved!\");
              window.location.assign(\"../index.php\");
          </script>";
    

}

?>