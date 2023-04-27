
<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM address WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Deleted the user";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Failed to delete the user";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $addrs = mysqli_real_escape_string($con, $_POST['addrs']);
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    // $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "UPDATE address SET name='$name', email='$email', phone='$phone',addrs='$addrs', pincode='$pincode',state='$state',country='$country' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User details saved successfully!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Failed to update user!";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_user']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $addrs = mysqli_real_escape_string($con, $_POST['addrs']);
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
    $addrs = mysqli_real_escape_string($con, $_POST['addrs']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $country = mysqli_real_escape_string($con, $_POST['country']);

    $query = "INSERT INTO address (name,email,phone,addrs,pincode,state,country) VALUES ('$name','$email','$phone','$addrs','$pincode','$state','$country')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "User added!";
        header("Location: create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Failed to create user!";
        header("Location: create.php");
        exit(0);
    }
}

?>