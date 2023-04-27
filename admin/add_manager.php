<?php
require('../config.php');
// Define and initialise the variables for form
$firstname_err = $last_name_err = $email_err = $userPassword_err = $confirmPassword_err = '';
$first_name = '';
$last_name = '';
$email = '';
$userPassword = '';
$confirmPassword = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    // first check if the user is already registered or not
    $stmt = $con->prepare("SELECT * FROM manager where email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $stmt->store_result();
    echo $stmt->num_rows();
    if ($stmt->num_rows() != 0) {
        echo "<script>alert('User is already registered!')</script>";
    } else {
        // data validation
        $data_validation = 0;

        // define and initialise the error variables

        // firstname validation
        if (!preg_match("/^[a-zA-z]+$/", $first_name)) {
            $firstname_err = "Only alphabets and whitespace are allowed.";
            $data_validation = 0;
            // echo $firstname_err;
        } else {
            $data_validation = 1;
        }
        // lastname validation
        if (!preg_match("/^[a-zA-z]+$/", $last_name)) {
            $last_name_err = "Only alphabets and whitespace are allowed.";
            // echo $last_name_err;
            $data_validation = 0;
        } else {
            $data_validation = 1;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Email is not of valid format.";
            $data_validation = 0;
            // echo $email_err;
        } else {
            $data_validation = 1;
        }
        // Password match
        if (strlen($userPassword) < 8) {
            $userPassword_err = "Password must be at least 8 characters.";
            $data_validation = 0;
        } else if (!preg_match("#[0-9]+#", $userPassword)) {
            $userPassword_err = "Password must include at least one number!";
            $data_validation = 0;
        } else if (!preg_match("#[a-z]+#", $userPassword)) {
            $userPassword_err = "Password must include at least one lower case letter!";
            $data_validation = 0;
        } else if (!preg_match("#[A-Z]+#", $userPassword)) {
            $userPassword_err = "Password must include at least one upper case letter!";
            $data_validation = 0;
        } else if (!preg_match('/[^a-zA-Z\d]/', $userPassword)) {
            $userPassword_err = "Password must include at least one special character!";
            echo $userPassword;
            $data_validation = 0;
        } else if ($userPassword != $confirmPassword) {
            $confirmPassword_err = "Confirm password does not match with password";
            $data_validation = 0;
        } else {
            $data_validation = 1;
            $userPassword_err = $confirmPassword_err = '';
        }

        // echo $data_validation;
        if ($data_validation === 1) {
            $saltvalue = bin2hex(openssl_random_pseudo_bytes(16));

            $iterations = 1000;
            $sizeOfHash = 64;
            $hashedPassword = hash_pbkdf2("sha512", $userPassword, $saltvalue, $iterations, $sizeOfHash);
            $verified = 0;
            $stmt = $con->prepare("INSERT INTO manager(first_name, last_name,email, password, saltvalue, verified) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $first_name, $last_name, $email, $hashedPassword, $saltvalue, $verified);

            $stmt->execute();

            if ($stmt->affected_rows === 1) {
                echo "<script>alert('New user registered successfully!')</script>";
            } else {
                echo 'Error: ' . $stmt->error;
            }
        }
    }
}
if(isset($_POST['add_manager']))
{
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $query = "INSERT INTO manager (first_name,last_name,email,password) VALUES('$first_name','$last_name','$email,'$userPassword')";
}

?>

<!-- Design by foolishdeveloper.com -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            font-family: sans-serif;
        }

        body {
            height: 100vh;
            background: #e1edf9;
        }

        .wrapper {
            max-width: 450px;
            width: 100%;
            margin: 30px auto 0;
            padding: 10px;

        }

        .wrapper .form_container {
            background: #fff;
            padding: 30px;
            box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.15);
            border-radius: 3px;
        }

        .heading {
            background: #015a80;
            margin: -30px;
            text-align: center;
            color: white;
            font-size: 19px;
            margin-bottom: 35px;
            padding: 10px;


        }

        .wrapper .form_container .form_item {
            margin-bottom: 25px;
        }

        .form_wrap.fullname,
        .form_wrap.select_box {
            display: flex;
        }

        .form_wrap.fullname .form_item,
        .form_wrap.select_box .form_item {
            width: 50%;
        }

        .form_wrap.fullname .form_item:first-child,
        .form_wrap.select_box .form_item:first-child {
            margin-right: 4%;
        }

        .wrapper .form_container .form_item label {
            display: block;
            margin-bottom: 5px;
        }

        .form_item input,
        .form_item select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dadce0;
            border-radius: 3px;
        }

        .form_item input:focus {
            border-color: #6271f0;
        }

        .btn input[type="submit"] {
            background: #1598d4;
            border: 1px solid #1598d4;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            letter-spacing: 1px;
            border-radius: 3px;
            cursor: pointer;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="wrapper">


        <div class="form_container">
            <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="heading">
                    <h2>Add Manager FORM</h2>
                </div>
                <div class="form_wrap fullname">
                    <div class="form_item">
                        <label>First Name</label>
                        <input type="text" value="<?php echo (isset($first_name) ? $first_name : ''); ?>" name="firstname">
                        <div class="error" id="fname"><?php echo $firstname_err; ?></div>
                    </div>
                    <div class="form_item">
                        <label>Last Name</label>
                        <input type="text" value="<?php echo (isset($last_name) ? $last_name : ''); ?>" name="lastname">
                        <div class="error" id="lname"><?php echo $last_name_err; ?></div>
                    </div>
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Email Address</label>
                        <input type="text" value="<?php echo (isset($email) ? $email : ''); ?>" name="email">
                        <div class="error" id="email"><?php echo $email_err; ?></div>
                    </div>
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Password</label>
                        <input type="password" value="<?php echo (isset($userPassword) ? $userPassword : $userPassword_err); ?>" name="password">
                        <div class="error" id="Password"><?php echo $userPassword_err; ?></div>
                    </div>
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Confirm Password</label>
                        <input type="password" value="<?php echo (isset($confirmPassword) ? $confirmPassword : ''); ?>" name="confirm_password">
                        <div class="error" id="ConfirmPassword"><?php echo $confirmPassword_err; ?></div>
                    </div>
                </div>

                <div class="btn">
                    <input type="submit" name = "add_manager" value="ADD manager">
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <p>if you have already registered then click: <a href="manager_login.php">login</a></p>
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>

</html>