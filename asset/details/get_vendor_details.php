<?php 
require_once('../../config.php');
if (!empty($_POST["vendor_id"])) {
    $sql = "SELECT * FROM vendor WHERE vendor_id='".$_POST["vendor_id"]."'";
    $result = mysqli_query($db, $sql);
}
?>
<?php if ($result) { ?>
        <table border="2">
        <tr>
        <th>Selected Vendor</th>
        <th>Vendor Address</th>
        <th>Pincode</th>
        <th>Phone</th>
        </tr>
           <?php while($row = mysqli_fetch_array($result)) { ?>
           <tr>
            <td><?php echo $row['vendor_name']; ?></td>
            <td><?php echo $row['vendor_address']; ?></td>
            <td><?php echo $row['pincode']; ?></td>
            <td><?php echo $row['phone']; ?></td>
           </tr>
           <?php } ?> 
        </table>
<?php } ?>