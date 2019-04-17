
<?php

require_once("classes/User.php");
require_once("classes/Profile.php");
require_once("classes/Forum.php");

// https://themeforest.net/item/open-list-blogging-platform-template/20795475?s_rank=1

// Logic to update topic list for forums
if (isset($_POST['refresh-topics'])) {
	$query = http_build_query(array('topics' => $_POST['forum_topics']));
	header("Location: home.php?".$query);
}

// Load variable for topic lists
if (isset($_GET['topics'])) {
	$topic_list = $_GET['topics'];
} else {
	$topic_list = array();
}

?>

<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/posts.css">

<?php include("includes/header.php");?>

<div class="forum-topics">
	
	<form method="post">
		

		<?php
		// Logic for check boxes of topics
		foreach (Forum::get_forums() as $forum) {

			if (in_array($forum['forum_id'], $topic_list)) {
				?>
				<input type="checkbox" name="forum_topics[]" value="<?php echo $forum['forum_id'];?>" id="<?php echo $forum['forum_id'];?>" class="topic-checkbox" checked>
				<label for="<?php echo $forum['forum_id'];?>" class="topic-toggle active-topic"><?php echo $forum['title'];?></label>
				<?php
			} else {
				?>
				<input type="checkbox" name="forum_topics[]" value="<?php echo $forum['forum_id'];?>" id="<?php echo $forum['forum_id'];?>" class="topic-checkbox">
				<label for="<?php echo $forum['forum_id'];?>" class="topic-toggle"><?php echo $forum['title'];?></label>
				<?php
			}
		}
		?>

		<button type="submit" name="refresh-topics" class="refresh-topics">Refresh Topics</button>

	</form>
</div>

<div class="home-posts-container">
	

	<?php


	foreach (Forum::get_posts($topic_list) as $post) {

		$post_user = new Profile($post["user_id"]);
		$post_img = $post["post_img"];
		$title = $post["title"];
		$body = $post["message"];

		?>
		<div class="post">

			<?php
			if ($post_img) {
				echo '<img src="'.$post_img.'" class="post-picture">';
			}
			?>

			<div class="user-info">
				<img src="img/profiles/<?php echo $post_user::$profile_img;?>" class="post-profile-pic">
				<div class="poster-name"><?php echo $post_user::$full_name;?> <span><?php echo Forum::time_elapsed_string($post['date']);?></span></div>
			</div>

			<div class="post-title"><?php echo $title;?></div>

			<div class="post-preview"><?php echo $body;?></div>

		</div>

		<div class="post-spacer"></div>

		<?php
	}


	?>

</div>