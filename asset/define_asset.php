<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    }
require('../config.php');
include 'asset_server.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Asset Category</title>
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
          margin: 0px;
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
      <h2 class="text-center">Define Asset Category</h2>
      <form method="post" action="define_asset.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <div class="form-group">
            <select name="asset_type_select" class="form-control" id="asset_type_select" required="True">
                <option value="">Select Asset Type</option>
              <?php $sql="SELECT * FROM asset_type";
                    $result = mysqli_query($db, $sql) or die(mysqli_error());
                    if ($result) {
                        foreach ($result as $row) {
                            echo "<option value=".$row["asset_type_id"].">".$row["asset_type_name"]."</option>";
                        }
                    }
              ?>
            </select>
        </div>
        <div class="form-group">
            <select name="asset_class_select" class="form-control" id="asset_class_select" required="True">
                <option value="">Select Asset Class</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="add_asset_group"  class="form-control" placeholder="Asset Category(e.g. Smartphone)" 
            required="True">
        </div>
            <input type="submit" class="btn btn-success" name="asset_define_submit" value="Save">
            <a href="javascript:void(0)" onclick="window.location.replace('../index.php');">Cancel</a>
    </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
<script type="text/javascript">
    // GENERATE ASSET CLASS
    $("#asset_type_select").change(function(){
            var typeID = "";
            var typeID = $('#asset_type_select').val();

            $.ajax({
               type: 'post',
               url: 'details/get_asset_class.php',
               data: 'fk_asset_type_id=' + typeID,
               success: function (r) {
                   $('#asset_class_select').html(r);
               }
            });
        })
</script>
</html>