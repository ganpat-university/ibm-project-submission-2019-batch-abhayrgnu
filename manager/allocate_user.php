<?php
require('../config.php');
include('managerHeader.php');
include('managerFooter.php');


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $manager_id_fk = $_SESSION['manager_id'];

    // Update user record in database
    $stmt = $con->prepare("UPDATE user SET manager_id_fk = ? WHERE id = ?");
    $stmt->bind_param("ii", $manager_id_fk, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "User allocated successfully.";
        echo "<script>alert('$message'); window.location.href = 'http://localhost/sem8/manager/allocate_manager.php'</script>";

        exit();
    } else {
        $message = "Failed to allocate user.";
        echo "<script>alert('$message'); window.location.href = 'http://localhost/sem8/manager/allocate_manager.php'</script>";

        exit();
    }

    $stmt->close();
}
// If user_id parameter is not set, redirect to allocate_manager.php without the parameter
header("Location: allocate_manager.php");
exit();
?>