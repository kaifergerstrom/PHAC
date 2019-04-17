<?php
class DB {

	private static function connect() {

		$ip = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'phac';

		$pdo_string = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $ip, $database);
		$pdo = new PDO($pdo_string, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
	
	public static function query($query, $params = array()) {
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		
		if(explode(' ', $query)[0] == 'SELECT') {
			$data = $statement->fetchAll();
			return $data;
		}
		
	}

	public static function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public static function filtername($filename) {
		$new_file = strtolower($filename);
		$new_file = preg_replace('/\s+/', '', $new_file);
		
		return $new_file;
	}

}

?>
