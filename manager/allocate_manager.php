<?php
require('../config.php');
include('managerHeader.php');
// Check if message is set
if (isset($_GET['message'])) {
    $message = $_GET['message'];
} else {
    $message = "";
}
?>

<br>
<div id="page-wrapper">
    <div class='row'>
        <div class='col-sm-12'>
            <div class='white-box'>
                <h3>USERS WITHOUT MANAGERS</h3>
                <!-- <p class='text-muted m-b-20'>Add<code>.table-bordered</code>for borders on all sides of the table and
                    cells.</p> -->
                <div class='table-responsive'>
                    <caption><?php echo $message; ?></caption>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>NAME</td>
                                <th>EMAIL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get address records from database
                            $stmt = $con->prepare("SELECT first_name, last_name, id, email FROM user where manager_id_fk is null");
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($first_name, $last_name, $id, $email);
                            while ($stmt->fetch()) {
                                echo "
                                <tr>
                                    <td>$first_name&nbsp; $last_name<td>
                                    <td>$email</td>
                                    <td><a href='allocate_user.php?user_id=$id'> ALLOCATE TO ME </a></td>
                                </tr> ";
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('managerFooter.php');
?>