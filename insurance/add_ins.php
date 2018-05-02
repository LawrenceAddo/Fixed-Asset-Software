<?php require_once '../server.php';
if (!isset($_SESSION['username-admin'])) {
        header("location: ../index.php");
    } 
$admin = $_SESSION['username-admin'];
include 'ins_server.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADD | INSURANCE</title>
    <?php require '../cdn.php'; ?>
    <style type="text/css">
        <?php require '../short-page-footer-style.css'; ?>
        .error {
            color: tomato;
        }
        /* h2 {
          margin-bottom: 0px;
          color: white;
          background: #5f68a0;
          border: 1px solid #B0C4DE;
          border-bottom: none;
          border-radius: 10px 10px 0px 0px;
          padding: 20px;
          font-size: 25px;
        } */
        form {
          margin: 0px auto 10px auto;
          padding: 20px;
          background: #F8F8FF;
        }
        .panel-heading {
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include '../tools.php'; ?>
<div class="container-fluid">
  <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">Add Insurance for the Asset Items</h2>
            <form method="POST" action="add_ins.php">
                <div class="error"><?php include '../error.php'; ?></div>
                <div class="panel panel-group">
                    <input type="hidden" name="admin" value="<?php echo($admin); ?>">
                    <!--  <div class="panel panel-success">
                        <div class="panel-heading">ASSET OWNER DETAILS</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="owner_name" placeholder="Owner Name / Company" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="street" placeholder="Street / Locality / Area" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="City / Town" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="state" placeholder="State" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pincode" placeholder="Pincode" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile No." required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email ID" required>
                            </div>
                            <div class="form-group">
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <div class="panel panel-success">
                        <div class="panel-heading">ASSET SELECTION</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select name="asset_item" class="form-control" required="True">
                                    <option value="">Select Asset</option>
                                <?php $sql = "SELECT * FROM assets WHERE my_admin='$admin'";
                                    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<option value=".$row['asset_id'].">".$row['asset_name']."</option>";
                                     }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">INSURANCE DETAILS</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="ins_company" placeholder="Insurance Company" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ins_registration_no" placeholder="Policy Number" required>
                            </div>
                            <div class="form-group">
                                <select name="issued_for" class="form-control" required>
                                    <option value="">Select Insurance Issue Type</option>
                                    <option value="New">New</option>
                                    <option value="Renewal">Renewal</option>
                                    <option value="Roll-Over">Roll Over</option>
                                    <option value="Used">Used</option>
                                    <option value="Endorsement">Endorsement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="type_of_cover" class="form-control" required>
                                    <option value="">Type of Cover</option>
                                    <option value="Liability">Liability</option>
                                    <option value="Collision">Collision</option>
                                    <option value="Comprehensive">Comprehensive</option>
                                    <option value="Accidental">Accidental</option>
                                    <option value="Theft">Theft</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Rental">Rental</option>
                                    <option value="Full Coverage">Full Coverage</option>
                                    <!-- <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option> -->
                                </select>
                            </div>
                            <div class="form-inline">
                            <div class="form-group">
                                <label>Policy Period: </label>
                                <input type="text" name="policy_from" id="datepicker1" class="form-control" placeholder="From" required>
                                <input type="text" name="policy_to" id="datepicker2" class="form-control" placeholder="To" required>
                            </div></div>
                        </div>
                    </div>
                    <!-- <div class="panel panel-success">
                        <div class="panel-heading">FINANCER DETAILS</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select name="financer" class="form-control" required>
                                    <option value="">Select Finance Type</option>
                                    <option value="Hypothecation Agreement">Hypothecation Agreement</option>
                                    <option value="Hire Purchase">Hire Purchase</option>
                                    <option value="Lease Agreement">Lease Agreement</option>
                                    <option value="Self">Self Financed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Financer Name &amp; Address: </label>
                                <input name="financer_details" class="form-control" type="text" required>
                            </div>
                        </div>
                    </div> -->
                    <div class="panel panel-success">
                        <div class="panel-heading">PREMIUM DETAILS</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="premium_amt" placeholder="Premium Amount (incl. service tax) (in Rs.)" required>
                            </div>
                            <div class="form-group">
                                <select name="premium_period" class="form-control" required>
                                    <option value="">Select Interval for Premium</option>
                                    <option value="3 month">3 Months</option>
                                    <option value="6 month">6 Months</option>
                                    <option value="12 month">12 Months</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <select name="payment_mode" class="form-control" required>
                                    <option value="">Select Mode of Payment</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Demand Draft">Demand Draft</option>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="ch_or_dd_no" class="form-control" placeholder="Cheque/DD No." style="width: 50%;" required="False">
                            </div>
                            <div class="form-group">
                                <input type="text" name="ch_or_dd_date" id="datepicker3" class="form-control" placeholder="Cheque/DD Date" style="width: 30%;" required="False">
                            </div>
                            <div class="form-group">
                                <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="insured_bank" class="form-control" placeholder="Insured Bank Name and Address" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="acc_no" inputmode="numeric" class="form-control" placeholder="Account No." style="width: 50%" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="ifsc" class="form-control" placeholder="IFSC Code" style="width: 30%" required>
                            </div> -->
                        </div>
                    </div> 
                </div> <!-- PANEL GROUP ENDS HERE. -->
                <input type="submit" name="ins_sub" class="btn btn-success btn-lg">
            </form>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">
    // DATE PICKER - jQuery
      $( "#datepicker1" ).datepicker({
      });

    $( function() {
      $( "#datepicker2" ).datepicker();
    });

    $( function() {
      $( "#datepicker3" ).datepicker();
    });
</script>
</html>