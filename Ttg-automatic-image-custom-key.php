<?php 
/*
Plugin Name: TTG Automatic Image Custom Key 
Plugin URI: http://www.techtipsgeek.com
Description: This WordPress plugin generates custom key of the thumbnail automatically of the first image of your post
Author: Tanmay Ahmed (tanmay@techtipsgeek.com)
Version: 1.0
Author URI: http://www.techtipsgeek.com 
*/

if($_REQUEST['ttg_form']!='')
{
	update_option(ttg_activator,$_REQUEST['ttg_activator']);
	update_option(ttg_key,trim($_REQUEST['ttg_key']));
}
function ttg_checkbox($after,$before)
{
	if($after==$before){ return "checked='checked'"; }
}
 
function ttg_details()
{
	echo '<form action="" method="post"><br /><br /><strong>TTG Automatic Image Custom Key</strong><br /><br />
	<input name="ttg_activator" type="checkbox" '.ttg_checkbox(1,get_option("ttg_activator")).' value="1" /> Enable Automatic Image Custom Key
	<br /><br />
	Enter your custom key name (one custom key per line)
	<br /><br /><b>e.g.</b> <br />Thumbnail<br />articleimg<br />postimg<br />
<textarea name="ttg_key" cols="60" rows="6">'.get_option("ttg_key").'</textarea>
 <p class="submit"><input name="" type="submit" value="    Save    "><input type="hidden" name="ttg_form" value="1" ></p>

<b>usage:</b>
<br />
<p>use below code to show thumbnail in your template</p>
<p>$thumb = get_post_meta($post-&gt;ID, "Thumbnail", $single = true);<br>
  $thumb_alt = get_post_meta($post-&gt;ID, "Thumbnail-alt", $single = true);</p>
<p>(note: "<b>Thumbnail</b>" will be replaced by your own custom key)</p>

<br /><br />
for more details visit <a href="http://www.techtipsgeek.com" target="_blank">http://www.techtipsgeek.com</a>
';
} 

function ttg_auto() {
	add_options_page("TTG Automatic Image Custom Key", "TTG Automatic Image Custom Key", 8, "TTG Automatic Image Custom Key", "ttg_details");
}

function ttg_set_keys($id,$image_src,$image_alt)
{
	$arr=explode("\r",get_option("ttg_key"));
	for($i=0;$i<count($arr);$i++)
	{
		update_post_meta($id, $arr[$i], $image_src);
		update_post_meta($id, $arr[$i]."-alt", $image_alt);
	}
}
  function nl2p($text, $cssClass=''){

     // Return if there are no line breaks.
     if (!strstr($text, "\n")) {
         return $text;
     }

     // Add Optional css class
     if (!empty($cssClass)) {
         $cssClass = ' class="' . $cssClass . '" ';
     }

     // put all text into <p> tags
     $text = '<p' . $cssClass . '>' . $text . '</p>';

     // replace all newline characters with paragraph
     // ending and starting tags
     $text = str_replace("\n", "</p>\n<p" . $cssClass . '>', $text);

     // remove empty paragraph tags & any cariage return characters
     $text = str_replace(array('<p' . $cssClass . '></p>', '<p></p>', "\r"), '', $text);

     return $text;

   }

function ttg_generate()
{
	if( (get_post_meta($post->ID, "Thumbnail", true)=="") and get_option("ttg_activator")=="1")
	{
		global $post;
		$pattern = '!<img.*?src="(.*?)"!';
		preg_match_all($pattern, $post->post_content, $matches);
		$image_src = $matches['1'][0];

		$pattern = '!<img.*?alt="(.*?)"!';
		preg_match_all($pattern, $post->post_content, $matches);
		$image_alt = $matches['1'][0];
		if($image_alt=="")
		{
			$pattern = '!<img.*?title="(.*?)"!';
			preg_match_all($pattern, $post->post_content, $matches);
			$image_alt = $matches['1'][0];
		}
		
		ttg_set_keys($post->ID,$image_src,$image_alt);
	}
	return nl2p($post->post_content);
}

add_action('admin_menu', 'ttg_auto');
add_filter('the_content', 'ttg_generate');
add_action('admin_head', 'ttg_generate');
	 
?>
