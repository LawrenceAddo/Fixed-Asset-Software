<?php  include 'office_server.php';

if (isset($_GET['edit'])) { 
    $id = $_GET['edit']; # office_id

    $rec = mysqli_query($db, "SELECT * FROM office WHERE office_id=$id") or die(mysqli_error($db));
    $record = mysqli_fetch_array($rec);

    $office_nm = $record['office_name']; # office_name
    $office_addr = $record[2]; # office_address
    
    $sub_res = mysqli_query($db,
        "SELECT * FROM office_type WHERE office_id='".$record[3]."'") or 
        die(mysqli_error($db));
    if (mysqli_num_rows($sub_res) == 1) {
        $row = mysqli_fetch_array($sub_res);
        $main_office_name = $row['office_type']; # office_type => Head Office or Branch Office, etc.
    }
    
} ?>
<!DOCTYPE html>
<html>
<head>
    <title>Update | Office</title>
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
        <h2 class="text-center">Edit Office<br>
            <small class="text-muted" style="color: lightgray;">You can't edit the Office Type</small>
        </h2>
        <form method="post" action="edit.php">
          <div class="error"><?php include '../error.php'; ?></div>
            <input type="hidden" name="curr_office_id" value="<?php echo($id); ?>">
            <label>Office Type:</label>
          <div class="form-group">
                    <input class="form-control" type="text" placeholder="<?php echo $main_office_name; ?>" disabled>
          </div>
          <label>Office Name:</label>
          <div class="form-group">
              <input type="text" name="off_name" class="form-control" placeholder="Office Name" required="True" value="<?php echo $office_nm; ?>">
          </div>
          <label>Office Address:</label>
          <div class="form-group">
              <textarea type="text" name="off_addr" class="form-control" placeholder="Address" required="True" rows=5 style="resize: none;"><?php echo $office_addr; ?></textarea>
          </div>
          <button type="submit" class="btn btn-success" name="off_edit_submit">Update</button>
          <a href="view_offices.php">Cancel</a>
        </form>
    </div>
  </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>