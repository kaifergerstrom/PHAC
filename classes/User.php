
<?php

require_once("classes/DB.php");

class User {


	public static $user_id;
	public static $email;
	public static $firstname;
	public static $lastname;
	public static $profile_img;
	public static $full_name;

	public static function init() {

		if (self::isLoggedIn()) {
			self::$user_id = self::isLoggedIn();
			self::$email = DB::query('SELECT email FROM users WHERE user_id=:user_id', array(':user_id'=>self::$user_id))[0]['email'];
			self::$firstname = DB::query('SELECT firstname FROM users WHERE user_id=:user_id', array(':user_id'=>self::$user_id))[0]['firstname'];
			self::$lastname = DB::query('SELECT lastname FROM users WHERE user_id=:user_id', array(':user_id'=>self::$user_id))[0]['lastname'];
			self::$profile_img = DB::query('SELECT profile_img FROM users WHERE user_id=:user_id', array(':user_id'=>self::$user_id))[0]['profile_img'];
			self::$full_name = self::$firstname .' '. self::$lastname;
		}

	}

	public static function getId() {
		return self::isLoggedIn();
	}

	public static function isLoggedIn() {

		if (isset($_COOKIE['SNID'])) {
			if (DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
				$user_id = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
				if (isset($_COOKIE['SNID_'])) {
						return $user_id;
				} else {
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
						DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						return $user_id;
				}
			}
		}
		return false;
	}


}

?>