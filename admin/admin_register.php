<?php
include 'admin_server.php'; 
if (!isset($_SESSION['master'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
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
    </style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h2 class="text-center">Add Admin</h2>
      <form method="post" action="admin_register.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <div class="form-group">
            <input type="text" name="admin_id" class="form-control" placeholder="Username" required="True">
        </div>
        <div class="form-group">
            <input type="password" name="pass1" class="form-control" placeholder="Password" required="True">
        </div>
        <div class="form-group">
            <input type="password" name="pass2" class="form-control" placeholder="Confirm Password" required="True">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email ID" required="True">
        </div>
        <input type="submit" class="btn btn-success" name="admin_submit_reg" value="Save">
        <a href="javascript:void(0)" onclick="window.location.replace('master_index.php');">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>