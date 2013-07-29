<?php

function da2nlike($args, $echo = true, $clear = true){
	global $user_ID;
	
	get_currentuserinfo();
	
	if($user_ID == ''){
		$user_ID = $user_ID = 0;	
	} else {
		$user_ID = $user_ID;	
	}
	
	$da2nlike = new da2nlike(get_the_ID(), $user_ID);
	$post_meta = get_post_meta(get_the_ID(), 'da2nlike', true); 
	$content = '';
	
	if($post_meta != 'disabled'){
		// check first parameter
		switch ($args){
			case 'count':
				$content .= $da2nlike->likes_count;
			break;
			
			case 'button':
				$content .= $da2nlike->like_button();
			break;
		}
	}
	
	if($clear){
		$content .= '<br clear="all" />';	
	}
	
	// echo or return
	if($echo){
		echo apply_filters('da2nlike', $content);	
	} else {
		return apply_filters('da2nlike', $content);	
	}
} // end da2nlike

?>