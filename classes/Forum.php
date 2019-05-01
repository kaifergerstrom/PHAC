

<?php

require_once("classes/DB.php");

class Forum {


	public static function get_forums() {
		$forums = DB::query("SELECT title, forum_id FROM forums");
		return $forums;
	}

	public static function get_forum_dict() {
		$forums = DB::query("SELECT title, forum_id FROM forums");
		$forum_array = array();
		foreach ($forums as $forum) {
			$forum_array[$forum['forum_id']] = $forum['title'];
		}
		return $forum_array;
	}

	public static function get_forum_title($forum_id) {
		return self::get_forum_dict()[$forum_id];
	}

	public static function get_forum_ids() {

		$id_array = array();

		foreach (self::get_forums() as $forum) {
			array_push($id_array, $forum['forum_id']);
		}

		return array_unique($id_array);
	}

	public static function get_posts($forum_id_list) {

		$posts_array = array();

		foreach ($forum_id_list as $forum_id) {
			$posts = DB::query("SELECT * FROM posts WHERE forum_id=:forum_id", array(":forum_id"=>$forum_id));
			$posts_array = array_merge($posts_array, $posts);
		}

		usort($posts_array, "self::date_compare");  // Sort array by date
		$posts_array = array_reverse($posts_array);  // Reverse to be newest first!

		return $posts_array;

	}


	public static function time_elapsed_string($datetime, $full = false) {

		$now = new DateTime;
		$ago = new DateTime($datetime);

		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	function date_compare($element1, $element2) { 
		$datetime1 = strtotime($element1['date']); 
		$datetime2 = strtotime($element2['date']); 
		return $datetime1 - $datetime2; 
	}  


}

?>