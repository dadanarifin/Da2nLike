jQuery(document).ready(function($){
    $('table#da2nlike_settings tr:last-child').css('border-bottom', 'none');
	
	$('#da2nlike_style_list li span').each(function(){
		$(this).click(function(){
			$(this).prev().attr("checked", "checked");
			$('#da2nlike_style_list li span').removeClass('selected');
			$(this).addClass('selected');
		});
	});
	
	$('#da2nlike_colour_list li span').each(function(){
		$(this).hover(function(){
			$(this).css({position: 'relative'})
			$(this).stop().animate({ top: -4, left: -4, width: 38, height: 38}, 100);	
		}, function(){
			$(this).stop().animate({ top: 0, left: 0, width: 30, height: 30}, 100);
		});
		
		$(this).click(function(){
			$('input', this).attr("checked", "checked");
			$('#colorlabsproject_colour_list li span').removeClass('selected');
			$(this).addClass('selected');
		});
	});
});