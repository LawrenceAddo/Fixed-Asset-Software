<?php include '../server.php'; 
    if (!isset($_SESSION['username-admin'])) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
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
      <h2 class="text-center">Add User</h2>
      <form method="post" action="user_register.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <div class="form-group">
            <input type="text" name="fname" class="form-control" placeholder="First name" required="True">
        </div>
        <div class="form-group">
            <input type="text" name="sname" class="form-control" placeholder="Last name" required="True">
        </div>
        <div class="form-group">
            <input type="text" name="uname" class="form-control" placeholder="Username" required="True">
        </div>
        <div class="form-group">
          <select name="off_type" id="off_type" class="form-control" required="True">
            <option value="">Select Office Type</option>
            <?php require_once '../config.php';
              $sql = "SELECT * FROM office_type";
              $res = mysqli_query($db, $sql) or die(mysqli_error($db));
              while ($row = mysqli_fetch_array($res)) {
                echo "<option value=".$row['office_id'].">".$row['office_type']."</option>";
              }
             ?>
          </select>
        </div>
      <div class="form-group">
        <select name="off_loc" id="off_loc" class="form-control" required="True">
          <option value="">Select Location</option>
        </select>
      </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email ID" required="True">
        </div>
        <div class="form-group">
            <input type="text" name="mobile" class="form-control" placeholder="Mobile No." required="True">
        </div>
        <button type="submit" class="btn btn-success" name="register_submit">Register</button>
        <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
    </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">
  //Generate Locations
  $("#off_type").change(function(){
            var typeID = "";
            var typeID = $('#off_type').val();

            $.ajax({
               type: 'post',
               url: '../office/get_off_loc.php',
               data: 'off_id=' + typeID,
               success: function (r) {
                   $('#off_loc').html(r);
               }
            });
        })
</script>
</html>