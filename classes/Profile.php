<?php

require_once("classes/DB.php");

class Profile {

	public static $user_id;
	public static $email;
	public static $firstname;
	public static $lastname;
	public static $profile_img;
	public static $full_name;

	public function __construct($profile_id) {
		self::$user_id = DB::query('SELECT user_id FROM users WHERE user_id=:user_id', array(':user_id'=>$profile_id))[0]['user_id'];
		self::$email = DB::query('SELECT email FROM users WHERE user_id=:user_id', array(':user_id'=>$profile_id))[0]['email'];
		self::$firstname = DB::query('SELECT firstname FROM users WHERE user_id=:user_id', array(':user_id'=>$profile_id))[0]['firstname'];
		self::$lastname = DB::query('SELECT lastname FROM users WHERE user_id=:user_id', array(':user_id'=>$profile_id))[0]['lastname'];
		self::$profile_img = DB::query('SELECT profile_img FROM users WHERE user_id=:user_id', array(':user_id'=>$profile_id))[0]['profile_img'];
		self::$full_name = self::$firstname .' '. self::$lastname;
	}

}