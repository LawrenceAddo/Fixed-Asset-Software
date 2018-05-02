<?php include 'vendor_server.php';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM vendor WHERE vendor_id='".$id."'";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    $record = mysqli_fetch_array($res);

    $vendor_name = $record[1];
    $vendor_address = $record[2];
    $vendor_pincode = $record[3];
    $vendor_email = $record[5];
    $vendor_mobile = $record[4];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit | Vendor</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .error {
            color: tomato;
        }
        h2 {
          margin-bottom: 0px;
          color: white;
          background: #5f68a0;
          border: 1px solid #B0C4DE;
          border-bottom: none;
          border-radius: 10px 10px 0px 0px;
          padding: 20px;
          font-size: 25px;
        }
        form {
          margin: 0px auto 10px auto;
          padding: 20px;
          border: 1px solid #B0C4DE;
          background: #F8F8FF;
          border-radius: 0px 0px 10px 10px;
        }
    </style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h2 align="center">Edit Vendor</h2>
      <form method="post" action="edit.php">
          <div class="error"><?php include '../error.php'; ?></div>
          <input type="hidden" name="curr_v_id" value="<?php echo($id); ?>">
              <div class="form-group">
                  <input type="text" name="v_name" class="form-control" 
                  placeholder="Vendor Name" required="True" value="<?php echo($vendor_name); ?>">
              </div>
              <div class="form-group">
                  <textarea name="v_addr" class="form-control" rows="5" placeholder="Vendor Address" required="True" style="resize: none;"><?php echo $vendor_address; ?></textarea>
              </div>
              <div class="form-group">
                  <input type="text" name="pin" class="form-control" 
                  placeholder="Pincode" required="True" value="<?php echo($vendor_pincode); ?>">
              </div>
              <div class="form-group">
                  <input type="email" name="email" class="form-control" 
                  placeholder="Email ID" required="True" value="<?php echo($vendor_email); ?>">
              </div>
              <div class="form-group">
                  <input type="text" name="mob" class="form-control" 
                  placeholder="Mobile No." required="True" value="<?php echo($vendor_mobile); ?>">
              </div>              
              <input type="submit" name="vendor_edit_submit" class="btn btn-success" value="Update">
              <a href="../index.php">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>