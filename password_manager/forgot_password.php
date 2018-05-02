<?php 
include 'fgt_server.php'; # the forgot code is here
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
            <?php if (isset($_SESSION['reset'])) { ?>
                <h2 class="text-center"><?php echo $_SESSION['reset']; ?><br>
                <small class="text-muted" style="color: lightgray;">You are detected as <?php echo $_SESSION['utype']; ?></small></h2>
                  <form method="post" action="forgot_password.php">
                      <div class="error"><?php include '../error.php'; ?></div>
                        <input type="hidden" name="user_type" value="<?php echo $_SESSION['utype']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['uname']; ?>">
                          <div class="form-group">
                              <input type="password" class="form-control" name="new_pass1" 
                              placeholder="New Password" required="True">
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" name="new_pass2" 
                              placeholder="Confirm New Password" required="True">
                          </div>        
                          <input type="submit" name="rst_submit" class="btn btn-success" value="Update">
                        <a href="clr.php">Cancel</a>
                  </form>
              <?php } else { ?>
            <h2 class="text-center">Forgot Password?<br>
                <small class="text-muted" style="color: lightgray;">Facility valid for 'admins' or 'masters'.</small></h2>
          <form method="post" action="forgot_password.php">
              <div class="error"><?php include '../error.php'; ?></div>
                  <div class="form-group">
                      <input type="password" class="form-control" name="old_pass"
                      placeholder="Enter the last password you remember" required="True">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="old_name" 
                      placeholder="Username" required="True">
                  </div>
                  <div class="form-group">
                      <input type="email" class="form-control" name="old_email" 
                      placeholder="Email ID" required="True">
                  </div>
                  <input type="submit" name="fgt_submit" class="btn btn-success" value="Update">
                  <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
                  <?php } ?>
          </form>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>