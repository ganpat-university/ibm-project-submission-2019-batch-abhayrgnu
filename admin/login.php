<?php
declare(strict_types=1);

require 'vendor/autoload.php';
$secret = "XVQ2UIGO75XRUKJA";
$link =  \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('DAC', $secret, 'admin');
$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
echo $g->getCode($secret);
// if(isset($_POST['submit']))
// {
// 	$code = $_POST['password'];
// 	if ($g->checkCode($secret, $code)) {
// 		echo "YES \n";
// 	} else {
// 		echo "NO \n";
// 	}
// }

require('../config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get user record from database
    $stmt = $con->prepare("SELECT id, password, saltvalue, verified FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashedPassword, $saltvalue, $verified);
        $stmt->fetch();

        // Verify password
        $iterations = 1000;
        $sizeOfHash = 64;
        $inputPasswordHashed = hash_pbkdf2("sha512", $password, $saltvalue, $iterations, $sizeOfHash);

        if ($inputPasswordHashed === $hashedPassword) {
            // Password is correct and user is verified, set session variables
            if(isset($_POST['submit']))
			{
				$code = $_POST['pass-code'];
				

				if ($g->checkCode($secret, $code)) {
					$_SESSION["loggedin"] = true;
					$_SESSION["username"] = $email;
					$_SESSION["user_id"] = $id;
					header("location: index.php");
				} else {
					echo "NO \n";
				}
			}
            exit();
        } else {
            $errorMessage = "Invalid email or password.";
        }
    } else {
        $errorMessage = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
    </head>

    <body>
    
        <h1>Login</h1>
        <?php if (isset($errorMessage)): ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label>Email:</label>
            <input type="email" name="email" required>
            <br>
            <label>Password:</label>
            <input type="password" name="password" required>
            <br>
            <div style="width: 50%; margin: 10px auto;">
			<center><h1> Two factor authentication </h1></center>
			<center><img src="<?=$link;?>"></center><br>
	</div> 
   <br>
            <div class="form_wrap">
                    <div class="input-group">
                        <div class = "input-group-addon
						addon-diff-color">
							<span class="glyphicon
							glyphicon-lock"></span>
                    </div>
                    <label>Enter Code:</label>
					<input type="text" autocomplete="off" class="form-control" name = "pass-code"placeholder="Enter code">
                </div>
				</div>
            <br>
            		<!-- Re-captcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Re-captcha -->
<div class="g-recaptcha" data-sitekey="6LdqdzIlAAAAADs3iEIZibUD0e2J285RLYcvLYUi"></div>
<br>
            <button type="submit" name = "submit">Login</button>
        </form>
        <p>New User? <a href="register.php">SIGN-UP</a>
    </body>

</html>