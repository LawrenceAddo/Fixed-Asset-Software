<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    } $admin = $_SESSION['username-admin'];
include 'user_asset_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User Asset</title>
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
      <h2 class="text-center">Add Assets to Users</h2>
      <form method="post" action="add_user_asset.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <div class="form-group">
            <select name="employee" class="form-control" required="True">
              <option value="">Select Employee</option>
              <?php $sql = "SELECT * FROM users WHERE my_admin='$admin'";
                  $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<option value=".$row['user_ID'].">".$row['username']."</option>";
                  }
              ?>
            </select>
        </div>
        <div class="form-group">
          <label for="splsel" class="text-muted">Multiple select asset list (hold ctrl or shift (or drag with the mouse) to select more than one):</label>
          <select multiple="True" name="arr[]" class="form-control" id="splsel" required="True">
            <?php $sql = "SELECT * FROM assets WHERE my_admin='$admin'";
                  $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<option value=".$row['asset_id'].">".$row['asset_name']."</option>";
                  }
              ?>
          </select>
        </div>
        <div class="form-group">
            <input type="text" name="expire" class="form-control" id="datepicker1" placeholder="Return Date" required="True">
        </div>
        <button type="submit" class="btn btn-success" name="ua_submit">Save</button>
        <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">
  $( function() {
          $( "#datepicker1" ).datepicker();
        });
</script>
</html>