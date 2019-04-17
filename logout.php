<?php

require_once('classes/DB.php');

if (isset($_COOKIE['SNID'])) {
	DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
	setcookie("SNID", '1', time() - 3600, '/', NULL, NULL, TRUE);
	setcookie("SNID_", '1', time() - 3600, '/', NULL, NULL, TRUE);
}

?>