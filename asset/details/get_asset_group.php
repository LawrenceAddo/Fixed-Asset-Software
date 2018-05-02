<?php require '../../server.php';
$admin = $_SESSION['username-admin'];
require_once('../../config.php');
if (!empty($_POST["fk_asset_class_id"])) {
    $sql = "SELECT * FROM asset_group WHERE my_admin='$admin' and fk_asset_class_id='".$_POST["fk_asset_class_id"]."'";
    $result = mysqli_query($db, $sql);
}
?>
<option value="">Select Asset Group</option>
<?php  if ($result) { while ($row = mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["asset_group_id"]; ?>"><?php echo $row["asset_group_name"]; ?></option>
<?php } } else { ?>
<option value="">No Record Found.</option>
<?php } ?>