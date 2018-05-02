<div class="well">
    <b>No. of registered Users (in total):
    <?php $sql = "SELECT * FROM users where my_admin='".$_SESSION['username-admin']."'";
            $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            if ($res) {
                $num = mysqli_num_rows($res);
                 echo "$num";
            }
    ?></b>
    <hr>
    <b>No. of registered Assets (in total):
    <?php $sql = "SELECT * FROM assets where my_admin='".$_SESSION['username-admin']."'";
            $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            if ($res) {
                $num = mysqli_num_rows($res);
                 echo "$num";
            }
    ?></b>
    <hr>
    <b>No. of registered Vendors (in total):
    <?php $sql = "SELECT * FROM vendor where my_admin='".$_SESSION['username-admin']."'";
            $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            if ($res) {
                $num = mysqli_num_rows($res);
                 echo "$num";
            }
    ?></b>
    <hr>
    <b>No. of registered Offices (in total):
    <?php $sql = "SELECT * FROM office where my_admin='".$_SESSION['username-admin']."'";
            $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            if ($res) {
                $num = mysqli_num_rows($res);
                 echo "$num";
            }
    ?></b>
</div>