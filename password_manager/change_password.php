<?php 
require_once '../server.php';
if (isset($_SESSION['username'])) {
  header("location: ../index.php");
}
include 'password_server_admin.php';
include 'password_server_master.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
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
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h2 class="text-center">Update Password</h2>
      <form method="post" action="change_password.php">
          <div class="error"><?php include '../error.php'; ?></div>
              <div class="form-group">
                  <input type="password" class="form-control" name="old_pass"
                  placeholder="Current Password" required="True">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="new_pass1" 
                  placeholder="New Password" required="True">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="new_pass2" 
                  placeholder="Confirm New Password" required="True">
              </div>        
              <input type="submit" name="chg_submit" class="btn btn-success" value="Update">
              <?php if (isset($_SESSION['master'])) { ?>
                  <a href="javascript:void(0)" onclick="window.location.replace('../admin/master_index.php');">Cancel</a>
               <?php } else { ?>
                  <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
              <?php } ?>

      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>