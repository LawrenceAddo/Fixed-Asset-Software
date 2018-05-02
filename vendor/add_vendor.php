<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
}
include 'vendor_server.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
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
<?php include '../tools.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h2 align="center">Add Vendor</h2>
      <form method="post" action="add_vendor.php">
          <div class="error"><?php include '../error.php'; ?></div>
              <div class="form-group">
                  <input type="text" name="v_name" class="form-control" 
                  placeholder="Vendor Name" required="True">
              </div>
              <div class="form-group">
                  <textarea name="v_addr" class="form-control" rows="5" placeholder="Vendor Address" required="True" style="resize: none;"></textarea>
              </div>
              <div class="form-group">
                  <input type="text" name="pin" class="form-control" 
                  placeholder="Pincode" required="True">
              </div>
              <div class="form-group">
                  <input type="email" name="email" class="form-control" 
                  placeholder="Email ID" required="True">
              </div>
              <div class="form-group">
                  <input type="text" name="mob" class="form-control" 
                  placeholder="Mobile No." required="True">
              </div>              
              <input type="submit" name="vendor_submit" class="btn btn-success" value="Save">
              <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>