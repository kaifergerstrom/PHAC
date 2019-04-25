
<?php

require_once("classes/DB.php");
require_once("classes/User.php");

class Upload {

	public static function upload_file_to($file, $dest) {

		$error = "";

		$check = getimagesize($file["tmp_name"]);  // Check if file is a image

		if ($check) {  // First, check if image

			$user_folder = $dest."/".User::getId()."/";
			$user_folder = preg_replace('#/+#','/',$user_folder);

			if (!file_exists($user_folder)) {
				mkdir($user_folder);
			}

			// Assign values for targets, check later
			$target_filename = DB::generateRandomString(10).".png";
			$target_file = $user_folder . $target_filename;

			while (file_exists($target_file)) {  // Keep on running until file does not exists
				$target_filename = DB::generateRandomString(10).".png";
				$target_file = $dest . $target_filename;  // Update if the file exists
			}


			if (move_uploaded_file($file["tmp_name"], $target_file)) {

				// echo ("The file ". basename($file["name"]). " has been uploaded.");
				$upload_status = True;
				return $target_file;

			} else {
				$error = "Error: unexpected error uploading file";
				$upload_status = False;
			}

		} else {
			$error = "Error: the file uploaded is not image";
			$upload_status = False;
		}

		return array($upload_status, $error);

	}

}