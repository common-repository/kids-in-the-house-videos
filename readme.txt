=== Kids in the House Videos ===
Contributors: Kidsinthehouse
Tags: widget, posts, shortcode, video, embed
Requires at least: 3.0
Tested up to: 3.9.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily embed videos from http://www.kidsinthehouse.com. The world's largest parenting video library.

== Description ==
This plugin will allow you to easily add any video on <http://www.kidsinthehouse.com> to posts, pages and widget areas on your WordPress site.
After following the installation instructions above you are ready to embed videos. First find a video you would like to embed by visiting <http://www.kidsinthehouse.com> and browsing to the particular video you would like to embed on your WordPress site. Copy the URL of the video from the web browser's address bar, for example purposes here is a url to a specific video <http://www.kidsinthehouse.com/all-parents/parenting/parental-stress-and-anger/how-to-stop-yelling-at-your-kids>. 

**To Embed a Video on Posts and Pages using  shortcodes**
*shortcodes are simple snippets of text inside the visual editor*

In the visual editor of a post or page, either type or copy and paste the following short code using the actual Kids in the House video URL from above.

    [kith videourl="PUT URL HERE"]

Save the post or page and when you view it in a browser, you should see the embeded video. You can customize various options for the embeded video by adding more options to the shortcode. After going over each option with a basic description, we've included an example that you can cut and paste. Options you may specify in you snippet or shortcode include:

* **width** is the width of the embed, usually in pixels, so you would put 640 for 640 pixels wide, this will also except a value of small or can be omitted if you do not wish to specify an exact size.

* **height** is the height of the embed, see width description for more details.

* **autostart** determines whether the video automatically begins playing on page load

* **morelink** If the *Show More Link* checkbox is checked in the settings for this plugin, underneath each video a link back to Kidsinthehouse will be automatically inserted for visitors wishing to see more content from Kids in the House. This allows you to specify which page on KidsintheHouse.com this goes to. It could be the expert page or another video by the same expert, or the homepage, you can pick any kidsinthehouse.com URL. If left off, it defaults to the linking to http://www.kidsinthehouse.com

* **linktext** is the text used for the morelink option mentioned above. If left off it defaults to For more videos on parenting visit KidsintheHouse.com


Example snippet (shortcode) you can use:

    [kith videourl="PUT URL HERE" width="620" height="400" morelink="http://www.kidsinthehouse.com/teenager" linktext="For more videos on teenagers visit KidsintheHouse.com" autostart="TRUE"]

This is the method we recommended for most users, but if you want to embed a Kids in the House video in an area that is not a page or post, you may want to use our video widget. 

** Using the Kids in the House Video Widget **
*The Kids in the House video widget allows you to embed videos in any area that supports widgets like sidebars, footers, and headers*


In the widget manager in the WordPress dashboard accessible via Appearance Widgets, there will be a new available  widget title "Kids in the House Videos" listed under available widgets. 

Drag this widget to the area you want to add the embed video to. Click on the title of the newly dragged widget "Kids in the House Videos". A configuration form should drop down with various options you can customize.
The only one required is the video URL. First find a video you would like to embed by visiting <http://www.kidsinthehouse.com> and browsing to the particular video you would like to embed on your WordPress site. Copy the URL of the video from the web browser's address bar, for example purposes here is a url to a specific video - <http://www.kidsinthehouse.com/all-parents/parenting/parental-stress-and-anger/how-to-stop-yelling-at-your-kids> and put that in in the section that says *This is the video URL you want to embed* in the widget configuration form. The other options are the same as described in the shortcode section above and include width, height, autostart, morelink, and linktext.

After filling out the widget configuration form, hit save and view your site. The video should appear in the area the widget is placed in. To add more videos, under available Widgets drag another instance of **Kids in the House Video** to the widget area you want the video to appear. This is the same way you added the first one above. You can create as many Kids in the House videos widgets as you would like by dragging the Kids in the House Videos box from available widgets to the desired areas.

== Installation ==
1. Either Download/Unzip and Upload the folder kith-videos to the */wp-content/plugins/* directory, or follow the automatic instructions for installing plugins for the WordPress.org plugin repository.

2. Activate the plugin through the *Plugins* menu from the dashboard in WordPress (Same way you would activate any other plugin)

== Frequently Asked Questions ==
**Do I have to have an account on Kidsinthehouse.com to use this?** No, but we encourage you to create one for free anyways.

== Screenshots ==
1. A video embeded on a post
2. The Kids in the House Video widget backend configuration form
3. The shortcode that creates an embeded video within a post's visual editor.

== Changelog ==
Initial version - no changes yet

== Upgrade Notice ==
Initial version, so no reason to upgrade yet.