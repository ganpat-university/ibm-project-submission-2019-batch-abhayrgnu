<?php
require('../config.php');
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_login.php");
    exit;
}

echo "<script>alert('called');</script>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($con, $_POST['name']);
    // $email = mysqli_real_escape_string($con, $_SESSION['username']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $addrs = mysqli_real_escape_string($con, $_POST['addrs']);
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $user_id_fk = $_SESSION['user_id'];


    // Insert address into database
    $sql = "INSERT INTO address (name, phone, addrs, pincode, state, country, user_id_fk)
        VALUES ('$name', '$phone', '$addrs', '$pincode', '$state', '$country', '$user_id_fk')";

    if (mysqli_query($con, $sql)) {
        echo "Address added successfully";
        echo "<script>alert('inserted');window.location.href = 'http://localhost/sem8/user/collectAddress.php';</script>";
        exit();

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        echo "<script>alert('insert failed');window.location.href = 'http://localhost/sem8/user/collectAddress.php';</script>";

    }
}
?>