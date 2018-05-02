<?php include 'admin_server.php';

if (isset($_GET['edit'])) {
    $admin_id = $_GET['edit'];
    $rec = mysqli_query($db, "SELECT * FROM admins WHERE admin_ID='$admin_id'")
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);
    $admin_id = $record[0];
    $admin_pass = $record[1];
    $admin_email = $record[2];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update | Admin</title>
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
      <h2 class="text-center">Edit Admin<br>
            <small class="text-muted" style="color: lightgray;">
            You can't edit admin username</small>
        </h2>
      <form method="post" action="edit.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <input type="hidden" name="admin_uname" value="<?php echo($admin_id); ?>">
        <label>Username: </label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="<?php echo($admin_id); ?>" disabled>
        </div>
        <label>Password: </label>
        <div class="form-group">
            <input type="text" name="pass" class="form-control" placeholder="Password" required="True" value="<?php echo($admin_pass); ?>">
        </div>
        <label>Email ID:</label>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email ID" required="True" value="<?php echo($admin_email); ?>">
        </div>
        <input type="submit" class="btn btn-success" name="admin_edit" value="Save">
        <a href="master_index.php">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>