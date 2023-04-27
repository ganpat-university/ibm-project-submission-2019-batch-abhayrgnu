<?php
include "mail_function.php";
declare(strict_types=1); #2fa
require 'vendor/autoload.php';
require'validate.php';
$secret = 'XVQ2UIGO75XRUKJO';
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('DAC', $secret, 'user');

$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
echo $g->getCode($secret);


require('../config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form input
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Get user record from database
	$stmt = $con->prepare("SELECT id, password, saltvalue, verified FROM user WHERE email = ?");
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
					header("location: userDashboard.php");
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
		<meta charset="utf-8">
		<title>Login</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
			integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
			crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body>
		<div style="width: 50%; margin: 10px auto;">
			<center><h1> Two factor authentication </h1></center>
			<center><img src="<?=$link;?>"></center><br>
		</div> 
		<div class="register">
			<h1>Login</h1>
			<form method="post" autocomplete="off" action="validate.php">
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>

				
				<input type="password" name="password" placeholder="Password" id="password" required>

				<div class="form_wrap">
                    <div class="input-group">
                        <div class = "input-group-addon
						addon-diff-color">
							<span class="glyphicon
							glyphicon-lock"></span>
                    </div>
					<input type="text" autocomplete="off" class="form-control" name = "pass-code"placeholder="Enter code">
                </div>
				</div>

				<input type="submit" value="Login" name="submit">
				<?php if (isset($errorMessage)): ?>
					<p><?php echo $errorMessage; ?></p> <?php endif; ?>
			</form>
		</div>
	</body>

</html>