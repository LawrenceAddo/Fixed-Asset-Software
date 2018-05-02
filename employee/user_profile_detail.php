<div class="user_profile_details">
        <?php
        $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            echo "
            <table class=\"table table-striped table-responsive\">
            <thead>
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Mobile</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = mysqli_fetch_array($result)) {
                echo "
                <tr>
                <td>".$row['fname']."</td>
                <td>".$row['sname']."</td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td>".$row['mobile']."</td>
                </tr>
                ";
            }
            echo "
            </tbody>
            </table>
            ";
         ?>
</div>     