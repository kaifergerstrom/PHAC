
<?php

require_once("classes/DB.php");

$error = "";

// Form submit logic for login
if (isset($_POST['join-submit'])) {

	// Fetch all data from form
	$firstname = strip_tags($_POST['firstname-input']);
	$lastname = strip_tags($_POST['lastname-input']);
	$password = password_hash(strip_tags($_POST['password-input']), PASSWORD_BCRYPT);  // Hash and encrypt password from form
	$email = strip_tags($_POST['email-input']);

	$user_id = DB::generateRandomString();  // Generate unique user id
	$profile_img = 'default.png';

	if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
		if (strlen($password) >= 5 && strlen($password) <= 60) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				DB::query('INSERT INTO users VALUES (\'\', :user_id, :email, :password, :firstname, :lastname, :verified, :profile_img)', array(':user_id'=>$user_id, ':password'=>$password, ':email'=>$email, ':firstname'=>$firstname, ':lastname'=>$lastname, ':verified'=>False, ':profile_img'=>$profile_img));
			} else {
				$error = 'Invalid email';
			}
		} else {
			$error = 'Invalid password';
		}
	} else {
		$error = 'Email already exists!';
	}
	
}

?>

<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/login-logout.css">

<?php
	
if ($error != "") {
	echo "<div class='note'>".$error."</div>";
}

?>

<div class="outer">

	<div class="gradient">

		<form method="POST" class="join-form">

			<div class="form-title-container">
				<img class="form-logo" src="img/logo.png">
				<div class="form-title">Create Account</div>
			</div>
			<div class="form-spacer"></div>
			<input type="text" name="firstname-input" placeholder="firstname" class="form-input">
			<div class="form-spacer"></div>
			<input type="text" name="lastname-input" placeholder="lastname" class="form-input">
			<div class="form-spacer"></div>
			<input type="password" name="password-input" placeholder="password" class="form-input">
			<div class="form-spacer"></div>
			<input type="email" name="email-input" placeholder="email" class="form-input">
			<div class="form-spacer"></div>
			<button type="submit" name="join-submit" class="form-submit">CREATE ACCOUNT</button>
			<div class="form-spacer"></div>
			<div class='form-disclaimer'>Already have an account? <a href="login.php">Login to account</a></div>

		</form>

	</div>

</div>