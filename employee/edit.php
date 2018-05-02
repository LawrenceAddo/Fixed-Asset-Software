<?php include 'local_server.php';
if (isset($_GET['edit'])) { 
    $id = $_GET['edit']; # user_id

    $rec = mysqli_query($db, "SELECT * FROM `users` WHERE `user_ID`='$id'")
    or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);

    $first_name = $record[1];
    $last_name = $record[2];
    $uname = $record[3];
    $email_ID = $record[4];
    $mobile = $record[5];
    
    $sql_office = mysqli_query($db,"SELECT * FROM `office` WHERE `office_id`='".$record[6]."'")or die(mysqli_error($db));
    if (mysqli_num_rows($sql_office) == 1) {
        $row = mysqli_fetch_array($sql_office);
        $office_id = $row[0]; # ast_grp_name
        $office_name = $row[1];
        $office_address = $row[2];
        $fk_office_type_id = $row[3];
        $sql_office_type = mysqli_query($db,
        "SELECT * FROM `office_type` WHERE `office_id`='$fk_office_type_id'") or 
        die(mysqli_error($db));
        $row = mysqli_fetch_array($sql_office_type);
        $office_type_id = $row[0];
        $office_type_name = $row[1];
    }

    /*
    echo $id."<br>"; # pk_username
    echo $first_name ."<br>";
    echo $last_name ."<br>";
    echo $password."<br>";
    echo $email_ID."<br>";
    echo $mobile."<br>";
    echo $office_id."<br>";
    echo $office_name."<br>";
    echo $office_address."<br>";
    echo $office_type_id."<br>";
    echo $office_type_name."<br>";
    */
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update | User</title>
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
      <h2 class="text-center">Update User Info<br>
        <small class="text-muted" style="color: lightgray;">You can't edit the Username</small>
      </h2>
      <form method="post" action="edit.php">
        <div class="error"><?php include '../error.php'; ?></div>
        <label>Username:</label>
        <input type="hidden" name="uid" value="<?php echo($id); ?>">
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo($uname); ?>" disabled>
        </div>
        <label>First Name:</label>
        <div class="form-group">
            <input type="text" name="fname" class="form-control" placeholder="First name" required="True" value="<?php echo($first_name); ?>">
        </div>
        <label>Last Name:</label>
        <div class="form-group">
            <input type="text" name="sname" class="form-control" placeholder="Last name" required="True" value="<?php echo($last_name); ?>">
        </div>
        <label>Office Type:</label>
        <div class="form-group">
          <select name="off_type" id="off_type" class="form-control" required="True">
            <option value="<?php echo $office_type_id; ?>">
                <?php echo $office_type_name; ?>
            </option>
            <option value="">-------------------</option>
            <?php require_once '../config.php';
              $sql = "SELECT * FROM office_type";
              $res = mysqli_query($db, $sql) or die(mysqli_error($db));
              while ($row = mysqli_fetch_array($res)) {
                if ($row[1] != $office_type_name) {
                    echo "<option value=".$row['office_id'].">".$row['office_type']."</option>";
                }
              } ?>
          </select>
        </div>
        <label>Office Location:</label>
      <div class="form-group">
        <select name="off_loc" id="off_loc" class="form-control" required="True">
          <option value="<?php echo($office_id); ?>"><?php echo $office_name." - ".$office_address; ?></option>
        </select>
      </div>
        <label>Email ID:</label>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email ID" required="True" value="<?php echo($email_ID); ?>">
        </div>
        <label>Mobile No.</label>
        <div class="form-group">
            <input type="text" name="mobile" class="form-control" placeholder="Mobile No." required="True" value="<?php echo($mobile); ?>">
        </div>
        <button type="submit" class="btn btn-success" name="user_edit_submit">Update</button>
        <a href="users_list.php">Cancel</a>
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