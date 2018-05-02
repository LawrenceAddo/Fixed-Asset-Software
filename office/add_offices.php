<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'office_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Office</title>
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
        <h2 class="text-center">Add Office</h2>
        <form method="post" action="add_offices.php">
          <div class="error"><?php include '../error.php'; ?></div>
          <div class="form-group">
              <select name="off_type" class="form-control" required="True">
                <option value="">Select Office Type</option>
                <?php $sql = "SELECT * FROM office_type";
                    $res = mysqli_query($db, $sql) or die(mysqli_error());
                    while ($row = mysqli_fetch_array($res)) {
                      echo "<option value=".$row['office_id'].">".$row['office_type']."</option>";
                    }
                ?>
              </select>
          </div>
          <div class="form-group">
              <input type="text" name="off_name" class="form-control" placeholder="Office Name" required="True">
          </div>
          <div class="form-group">
              <input type="text" name="addr[]" class="form-control" placeholder="Street" required="True">
          </div>
          <div class="form-group">
              <input type="text" name="addr[]" class="form-control" placeholder="City" required="True">
          </div>
          <div class="form-group">
              <input type="text" name="addr[]" class="form-control" placeholder="Pincode" required="True">
          </div>
          <div class="form-group">
              <input type="text" name="addr[]" class="form-control" placeholder="State" required="True">
          </div>
          <button type="submit" class="btn btn-success" name="off_submit">Save</button>
          <a href="../index.php">Cancel</a>
        </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>