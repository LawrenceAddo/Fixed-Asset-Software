<?php 
require_once('../../config.php');
if (!empty($_POST["fk_asset_type_id"])) {
    $sql = "SELECT * FROM asset_class WHERE fk_asset_type_id='".$_POST["fk_asset_type_id"]."'";
    $result = mysqli_query($db, $sql);
}
 ?>
<?php echo $sql; ?>
<option value="">Select Asset Class</option>
<?php 
if ($result) { while($row = mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["asset_class_id"]; ?>"><?php echo $row["asset_class_name"]; ?></option>
<?php } } ?>