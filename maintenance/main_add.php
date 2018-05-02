 <?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
include 'maintenance_server.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Maintenance</title>
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
      <h2 align="center">Add Maintenance records</h2>
      <form method="post" action="main_add.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <div class="form-group">
          <select name="ast_id" class="form-control" id="splsel" required="True">
            <option value="">Select an Asset</option>
            <?php $sql = "SELECT * FROM assets WHERE my_admin='".$_SESSION['username-admin']."'";
                  $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<option value=".$row['asset_id'].">".$row['asset_name']."</option>";
                  }
              ?>
            </select>
        </div>
          <div class="form-group">
              <input type="text" name="m_cost" class="form-control" 
              placeholder="Cost for Maintenance" required="True">
          </div>
          <div class="form-group">
            <input type="text" name="repair_date" class="form-control" id="datepicker1" placeholder="Maintenance Date" required="True">
        </div>
          <div class="form-group">
              <input type="text" name="repair_shop" class="form-control" 
              placeholder="Repair Shop Name" required="True">
          </div>
          <div class="form-group">
              <textarea type="text" rows="5" name="repair_shop_addr" class="form-control" 
              placeholder="Shop Address" required="True" style="resize: none;"></textarea>
          </div>
          <div class="form-group">
              <input type="text" name="contact_no" class="form-control" 
              placeholder="Contact No." required="True">
          </div>              
          <input type="submit" name="main_submit" class="btn btn-success" value="Submit">
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