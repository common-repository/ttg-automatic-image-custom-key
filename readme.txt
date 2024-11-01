=== Plugin Name ===
Plugin Name: Ttg-automatic-image-custom-key
Author: Tanmay Ahmed
plugin URI: http://www.techtipsgeek.com/create-featured-section-thumbnail-wordpress-blog/7025/

Tags: automatic custom key generator, automatic thumbnail generator, automatic custom key, automatic thumbnail, Ttg plugins
Requires at least: WP 2.0.2+
Tested up to: 2.9.0
version: 1.0

== Description ==

This plugin automatically generates custom key of very first the post image.


<b>::Manual::</b>

To show the thumbnail any where in your template use the code bellow

$thumb = get_post_meta($post->ID, "Thumbnail", $single = true);
$thumb_alt = get_post_meta($post->ID, "Thumbnail-alt", $single = true);

(note: Replace "Thumbnail" by your own custom key)

== Installation ==

1. Download the zipped plugin file to your local machine
2. Unzip the file.
3. Upload the "TTG Automatic Image Custom Key" folder to the "/wp-content/plugins/" directory.
4. Activate the plugin from the "Plugins" menu in WordPress.

--------
To learn more visit http://www.techtipsgeek.com
== Screenshots ==

screenshot.png

If you like this plugin then feel free to give dofollow backlink from your site.

