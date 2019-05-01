<?php
require_once("classes/Forum.php");
require_once("classes/Upload.php");

$error = "";

date_default_timezone_set("America/New_York");  // Set the timezone to New York

if (isset($_POST['upload-btn'])) {

	$post_title = strip_tags($_POST['post-title']);
	$post_desc = strip_tags($_POST['post-desc']);
	$forum_id = strip_tags($_POST['post-topic']);

	$target_dir = "uploads/";

	// If there is a picture attached (not required)
	if ($_FILES["fileToUpload"]["name"] != "") {

		$file_uploaded = Upload::upload_file_to($_FILES["fileToUpload"], $target_dir);

		if (is_array($file_uploaded)) {
			$error = $file_uploaded[1];
		}

	} else {
		$file_uploaded = "";
	}


	if (strlen($post_title) >= 5 && strlen($post_title) <= 60) {

		if (strlen($post_desc) >= 5) {

			if ($forum_id) {

				// Passes all the checks
				$now = new DateTime;
				$currdate = $now->format('Y-m-d H:i:s');
				$post_id = DB::generateRandomString();
				$user_id = User::getId();

				if (!is_array($file_uploaded)) {
					DB::query('INSERT INTO posts VALUES (\'\', :forum_id, :post_id, :user_id, :title, :message, \'\', 0, 0, :post_img, :currdate)', array(':forum_id'=>$forum_id, ':post_id'=>$post_id, ':user_id'=>$user_id, ':title'=>$post_title, ':message'=>$post_desc, ':post_img'=>$file_uploaded, ':currdate'=>$currdate));
				}


			} else {
				$error = 'No forum selected';
			}

		} else {
			$error = 'Invalid post description';
		}

	} else {
		$error = 'Invalid title';
	}

}


?>


<link rel="stylesheet" type="text/css" href="css/upload.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

if ($error != "") {
	echo "<div class='note'>".$error."</div>";
}

?>


<div class="overlay">

	<form method="POST" class="upload-form" id="upload-form" name="upload-form" enctype="multipart/form-data">

		<div class="form-title">Create a New Post</div>

		<div class="form-spacer"></div>

		<input class="form-control form-control-lg" type="text" placeholder="Add a title" name="post-title">

		<div class="form-spacer"></div>

		<textarea class="form-control" id="upload-desc" rows="3" placeholder="Add the description" name="post-desc"></textarea>

		<div class="form-spacer"></div>

		<select class="custom-select custom-select-lg mb-3" id="upload-select" name="post-topic">
			
			<option value="" disabled selected>Choose a category</option>

			<?php
				foreach (Forum::get_forums() as $forum) {
					echo "<option value='".$forum['forum_id']."'>".$forum['title']."</option>";
				}
			?>
		</select>

		<div class="form-spacer"></div>

		<div class="custom-file">
			<input type="file" class="custom-file-input" id="customFile" name="fileToUpload">
			<label class="custom-file-label" for="customFile">Choose file</label>
		</div>

		<div class="form-spacer"></div>

		<button type="submit" class="upload-btn" name="upload-btn">PUBLISH</button>

		<div class="form-spacer"></div>

		<button id="close-upload-form" type="button"><i class="fas fa-times"></i></button>

	</form>



</div>
