function da2nlike(post_id, user_id, type){
	if(post_id >= 1 && (user_id == 0 || user_id >= 0)){
		if (type === 'like') {
			
			// like button clicked
			jQuery('#da2nlike-post-'+post_id+' .da2nlike_like_unlike').addClass('da2nlike_loading');
			
			jQuery.post(da2nlike_url + '/',
						{post_id: post_id, user_id: user_id, like: 'like'}, 
						function(result){
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_count').remove();	
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_like_unlike').remove();
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_linebreaker.last').remove();
							
							jQuery('#da2nlike-post-'+post_id+'').append(result)
							
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_icon').replaceWith('<span class="da2nlike_icon" onclick="da2nlike('+post_id+', '+user_id+', \'unlike\');">&nbsp;</span>');
						});
			
		} else if (type === 'unlike') {
			
			// unlike button clicked
			jQuery('#da2nlike-post-'+post_id+' .da2nlike_like_unlike').addClass('da2nlike_loading');
			
			jQuery.post(da2nlike_url + '/',
						{post_id: post_id, user_id: user_id, like: 'unlike'}, 
						function(result){
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_count').remove();	
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_like_unlike').remove();
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_linebreaker.last').remove();
							
							jQuery('#da2nlike-post-'+post_id+'').append(result)
							
							jQuery('#da2nlike-post-'+post_id+' .da2nlike_icon').replaceWith('<span class="da2nlike_icon" onclick="da2nlike('+post_id+', '+user_id+', \'like\');">&nbsp;</span>');
						});
					
		} // end like type check
	} // end post id check
} // end da2nlike