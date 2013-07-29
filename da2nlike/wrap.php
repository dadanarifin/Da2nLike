<?php
$checked = '';

if(get_option('da2nlike_capabilities') === 'users-only'){
	$checked = 'checked';	
}

if(isset($_GET['saved']) && $_GET['saved']) echo '<div id="message" class="updated fade"><p><strong>Da2nLike settings updated</strong></p></div>';
?>

<div id="da2nlike_wrap" class="wrap">

	<h2>Da2nLike Settings</h2>
	
	<form action="" method="post">
		<table class="form-table" id="da2nlike_settings">
			<tr>
				<th><label for="da2nlike_capabilities">Limit to users only</label></th>
				<td><label for="da2nlike_capabilities"><input type="checkbox" name="da2nlike_capabilities" id="da2nlike_capabilities" <?php echo $checked ?>> Yes</label></td>
			</tr>
			<tr>
				<th><label for="da2nlike_like_txt">Like text</label></th>
				<td><input type="text" name="da2nlike_like_txt" id="da2nlike_like_txt" size="50" value="<?php if(get_option('da2nlike_like_txt')) echo get_option('da2nlike_like_txt') ?>"></td>
			</tr>
			<tr>
				<th><label for="da2nlike_unlike_txt">Unlike text</label></th>
				<td><input type="text" name="da2nlike_unlike_txt" id="da2nlike_unlike_txt" size="50" value="<?php if(get_option('da2nlike_unlike_txt')) echo get_option('da2nlike_unlike_txt') ?>"></td>
			</tr>
			<tr>
				<th><label for="da2nlike_widget_txt">Widget likes count text</label></th>
				<td><input type="text" name="da2nlike_widget_txt" id="da2nlike_widget_txt" size="50" value="<?php if(get_option('da2nlike_widget_txt')) echo get_option('da2nlike_widget_txt') ?>"></td>
			</tr>
			<tr>
				<th><label for="da2nlike_style">Da2nLike Style</label></th>
				<td>
					<ul id="da2nlike_style_list">
						<li><input type="radio" name="da2nlike_style" value="style_1" <?php if(get_option('da2nlike_style') == 'style_1') echo checked ?>><span class="style_1"></span></li>
						<li><input type="radio" name="da2nlike_style" value="style_2" <?php if(get_option('da2nlike_style') == 'style_2') echo checked ?>><span class="style_2"></span></li>
						<li><input type="radio" name="da2nlike_style" value="style_3" <?php if(get_option('da2nlike_style') == 'style_3') echo checked ?>><span class="style_3"></span></li>
					</ul>
				</td>
			</tr>
			<tr>
				<th><label for="da2nlike_colour">Colour scheme</label></th>
				<td>
					<ul id="da2nlike_colour_list">
						<li><span class="red"><input type="radio" name="da2nlike_colour" value="red" <?php if(get_option('da2nlike_colour') == 'red') echo checked ?>></span></li>
						<li><span class="pink"><input type="radio" name="da2nlike_colour" value="pink" <?php if(get_option('da2nlike_colour') == 'pink') echo checked ?>></span></li>
						<li><span class="purple"><input type="radio" name="da2nlike_colour" value="purple" <?php if(get_option('da2nlike_colour') == 'purple') echo checked ?>></span></li>
						<li><span class="blue"><input type="radio" name="da2nlike_colour" value="blue" <?php if(get_option('da2nlike_colour') == 'blue') echo checked ?>></span></li>
						<li><span class="sky_blue"><input type="radio" name="da2nlike_colour" value="sky-blue" <?php if(get_option('da2nlike_colour') == 'sky-blue') echo checked ?>></span></li>
						<li><span class="greeny_sky_blue"><input type="radio" name="da2nlike_colour" value="greeny_sky-blue" <?php if(get_option('da2nlike_colour') == 'greeny_sky-blue') echo checked ?>></span></li>
						<li><span class="green"><input type="radio" name="da2nlike_colour" value="green" <?php if(get_option('da2nlike_colour') == 'green') echo checked ?>></span></li>
						<li><span class="greeny_yellow"><input type="radio" name="da2nlike_colour" value="greeny-yellow" <?php if(get_option('da2nlike_colour') == 'greeny-yellow') echo checked ?>></span></li>
						<li><span class="yellow"><input type="radio" name="da2nlike_colour" value="yellow" <?php if(get_option('da2nlike_colour') == 'yellow') echo checked ?>></span></li>
						<li><span class="orange"><input type="radio" name="da2nlike_colour" value="orange" <?php if(get_option('da2nlike_colour') == 'orange') echo checked ?>></span></li>
						<li><span class="orangey_red"><input type="radio" name="da2nlike_colour" value="orangey-red" <?php if(get_option('da2nlike_colour') == 'orangey-red') echo checked ?>></span></li>
						<li><span class="black"><input type="radio" name="da2nlike_colour" value="black" <?php if(get_option('da2nlike_colour') == 'black') echo checked ?>></span></li>
					</ul>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					<input class="button-primary" name="da2nlike_save" type="submit" value="Save changes" />
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- end da2nlike wrap -->