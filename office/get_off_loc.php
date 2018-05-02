<?php require '../server.php';
$admin = $_SESSION['username-admin'];
require_once('../config.php');
if (!empty($_POST["off_id"])) {
    $sql = "SELECT * FROM office WHERE my_admin='$admin' AND fk_office_type_id='".$_POST["off_id"]."'";
    $result = mysqli_query($db, $sql);
}
 ?>
<?php echo $sql; ?>
<option value="">Select Location</option>
<?php 
if ($result) { while($row = mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["office_id"]; ?>"><?php echo $row["office_name"]." - ".$row["office_address"]; ?></option>
<?php } }  ?>