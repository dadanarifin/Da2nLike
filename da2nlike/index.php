<?php

require_once(dirname(__FILE__) . '/../../../wp-load.php');		// includes wordpress loads for using wordpress vars
require_once(dirname(__FILE__) . '/class.da2nlike.php');		// includes da2nlike class to process likes and unlikes


$da2nlike = new da2nlike($_POST['post_id'], $_POST['user_id']);	// new da2nlike class
$post_id = $_POST['post_id'];									// gets post id
$user_id = $_POST['user_id'];									// gets user id
$like = $_POST['like'];											// gets like type (returns like or unlike)
$button_txt = '';
$button_onclick = '';


// process likes & unlikes
if($like === 'like' && preg_match('/^([0-9]+)$/', $post_id . $user_id)){
	
	$da2nlike->like_post();
	$button_txt = $da2nlike->unlike_txt;
	$button_onclick = 'da2nlike(' . $post_id . ', ' . $user_id . ', \'unlike\')';
	
} elseif($like === 'unlike' && preg_match('/^([0-9]+)$/', $post_id . $user_id)){
	
	$da2nlike->unlike_post();
	$button_txt = $da2nlike->like_txt;
	$button_onclick = 'da2nlike(' . $post_id . ', ' . $user_id . ', \'like\')';
	
}

// count likes
$da2nlike->likes_count();

$result =  '<span class="da2nlike_count">' . $da2nlike->likes_count . '</span>';
$result .= '<span class="da2nlike_linebreaker last"></span>';
$result .= '<span class="da2nlike_like_unlike" onclick="'.$button_onclick.'">' . $button_txt . '</span>';

// echos the result
echo $result;

?>