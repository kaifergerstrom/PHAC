
<?php

require("classes/DB.php");

$error = "";

// Form submit logic for login
if (isset($_POST['login-submit'])) {

	$email = strip_tags($_POST['email-input']);
	$password = strip_tags($_POST['password-input']);

	if (DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
		if (password_verify($password, DB::query('SELECT password FROM users WHERE email=:email', array(':email'=>$email))[0]['password'])) {
			$verified = DB::query('SELECT verified FROM users WHERE email=:email', array(':email'=>$email))[0]['verified'];
			if ($verified) {
				
				// Logged in!
				$cstrong = True;
				$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				$user_id = DB::query('SELECT user_id FROM users WHERE email=:email', array(':email'=>$email))[0]['user_id'];

				// Create a cookie for user
				DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
				setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
				setcookie('SNID_', '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

				header("Location: home.php");

			} else {
				$error = 'Account not verified. Please wait for administrator to verify information.';
			}
		} else {
			$error = 'Invalid Email/Password combination'; 
		}
	} else {
		$error = 'Invalid Email/Password combination';
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

		<form method="POST" class="login-form">

			<div class="form-title-container">
				<img class="form-logo" src="img/logo.png">
				<div class="form-title">Member Login</div>
			</div>
			<div class="form-spacer"></div>
			<input type="email" name="email-input" placeholder="email" class="form-input">
			<div class="form-spacer"></div>
			<input type="password" name="password-input" placeholder="password" class="form-input">
			<div class="form-spacer"></div>
			<button type="submit" name="login-submit" class="form-submit">LOGIN</button>
			<div class="form-spacer"></div>
			<div class='form-disclaimer'>Not registered? <a href="join.php">Create an account</a></div>

		</form>

	</div>

</div>