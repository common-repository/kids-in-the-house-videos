<?php
/**
 * Plugin Name: Kids in the House Videos
 * Plugin URI: http://www.kidsinthehouse.com/software/wordpress-plugins
 * Description: Embed amazing videos from Kidsinthehouse.com on a WordPress site
 * Version: 1.0
 * Author: Kids in the House
 * Author URI: http://www.kidsinthehouse.com
 * License: GPL2
*/

/*  Copyright 2014  Kids in the House  (email : office@kidsinthehouse.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action('admin_menu', 'kith_videos_menu');
add_shortcode( 'kith', 'kith_videos_shortcode_fn');

function kith_videos_shortcode_fn($attributes, $content = null){

    extract( shortcode_atts( array(
        'videourl' => '',
        'width' => '620',
        'height' => '400',
        'autostart' => 'false',
        'morelink' => 'http://www.kidsinthehouse.com',
        'linktext' => 'For more expert parenting and pregnancy advice visit KidsintheHouse.com'
    ), $attributes ) );

    //print 'second video url is'.$videourl;
   $output = kith_videos_generate_embed_code($videourl,$width,$height,$autostart,$morelink,$linktext);
   $output = str_replace('&amp;','&',$output);
   return $output;
}
function kith_videos_adding_scripts() {
    wp_register_style('kith_videos', plugins_url('kith-videos/kith-videos.css'));
	wp_enqueue_style('kith_videos');
	}

	add_action( 'wp_enqueue_scripts', 'kith_videos_adding_scripts' );

function kith_videos_generate_embed_code( $videourl = NULL, $width = '402', $height = '622', $autostart = 'false', $morelink = 'http://www.kidsinthehouse.com', $linktext = 'For more expert parenting and pregnancy advice visit KidsintheHouse.com' ){
    if( empty($videourl) || (stripos($videourl, 'kidsinthehouse.com') == FALSE) ){
        return;
    }
    else{
        $videourl = explode("?", $videourl, 2);
        $videourl = $videourl[0];
    $pos1 = stripos($videourl, '.com/');
    if( isset($pos1) ){
      $videourl = substr($videourl, $pos1+5);
      $pos2 = stripos($videourl, '?');
    }
    if( $width == 'small' ){
            $width = '482';
            $height ='311';
    }

      $output =
<<<EOD
        <span class="kithambassador">
        <iframe class="kith-video-embed" width="$width" height="$height" scrolling="no"  frameborder="0" src="//www.kidsinthehouse.com/video-embed?videourl=$videourl&width=$width&height=$height&autoStart=$autostart"></iframe>
EOD;
        $showmorelink = get_option('kith-videos-setting', FALSE);

        if($showmorelink == '1' || $linktext !== 'For more expert parenting and pregnancy advice visit KidsintheHouse.com'){
            if(stripos($morelink, 'kidsinthehouse.com')== FALSE){
                $morelink ='http://www.kidsinthehouse.com';
            }
            $output .= '<a class="kithlink" href="'.$morelink.'" title="For more expert parenting and pregnancy advice visit KidsintheHouse.com">'.$linktext.'</a>';
        }
        $output .= '</span>';

    return $output;
    }
}

function kith_videos_menu(){
    add_options_page('KITH Videos', 'KITH Videos', 'manage_options', 'kith-videos', 'kith_videos_options');
}

function kith_videos_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
  echo '<div class="wrap">';
  echo '<h2>Kids in the House Videos</h2>';
  echo '<form action="options.php" method="POST" >';
  echo '<p>This is the settings page for Kids in the House wordpress plugin. For now, it does not have many custimization options, but with upcoming updates, more choices will appear here. </p>';
  settings_fields( 'kith-videos-settings-group' );
  do_settings_sections( 'kith-videos' );
  submit_button();
  echo '</form>';
  echo '</div>';
}


add_action( 'admin_init', 'kith_videos_admin_init' );

function kith_videos_admin_init() {
    register_setting( 'kith-videos-settings-group', 'kith-videos-setting' );
    add_settings_section( 'kith-section-one', 'General Settings', 'kith_section_one_callback', 'kith-videos' );
    add_settings_field( 'kith-field-one', 'Show More Link', 'kith_field_one_callback', 'kith-videos', 'kith-section-one' );
}

function kith_section_one_callback() {
    echo '<p>If the "Show More Link checkbox below is checked, underneath each embeded video will be a small link back to KidsintheHouse. The destination and text for this link is custimizeable, but must point to somewhere on the KidsintheHouse.com website. We ask that you check this and help other users discover the great content at KidsintheHouse.com and thank you for embedding and sharing our content.</p> ';
}

function kith_field_one_callback(){
  //$setting = esc_attr( get_option( 'kith-videos-setting' ) );
  echo "<input type='checkbox' id='kith-videos-setting' name='kith-videos-setting' value='1'".checked(1, get_option('kith-videos-setting'), false) . '/>';
}


/**
 * Create WordPress Widget
 */
  class kith_videos_widget extends WP_Widget{

      function kith_videos_widget(){
          parent::WP_Widget(false, $name = 'Kids in the House Videos');
      }

      function widget($args, $instance){
          extract( $args );
          //widget options
          $title = apply_filters('widget_title', $instance['title']);
          $videourl = $instance['videourl'];
          $height = $instance['height'];
          $width = $instance['width'];
          $autostart = $instance['autostart'];
          if($autostart == ''){
              $autostart = 'FALSE';
          }
          $morelink = $instance['morelink'];
          $linktext = $instance['linktext'];
          if( $title ){
              echo $before_title . $title . $after_title;

          }
          if( $videourl ){
              print kith_videos_generate_embed_code($videourl,$width,$height,$autostart,$morelink,$linktext);
          }

          echo $after_widget;
      }

      function update($new_instance, $old_instance){
          $instance = $old_instance;
          $instance['title'] = strip_tags($new_instance['title']);
          $instance['videourl'] = strip_tags($new_instance['videourl']);
          $instance['width'] = strip_tags($new_instance['width']);
          $instance['height'] = strip_tags($new_instance['height']);
          $instance['morelink'] = strip_tags($new_instance['morelink']);
          $instance['linktext'] = strip_tags($new_instance['linktext']);
          $instance['autostart'] = strip_tags($new_instance['autostart']);
          return $instance;
      }

      function form($instance){
          $title = esc_attr($instance['title']);
          $videourl = esc_attr($instance['videourl']);
          $width = esc_attr($instance['width']);
          $height = esc_attr($instance['height']);
          $morelink = esc_attr($instance['morelink']);
          $linktext = esc_attr($instance['linktext']);
          $autostart = esc_attr($instance['autostart']);
          ?>
          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title (Leave blank to hide title)'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('videourl'); ?>"><?php _e('This is the video URL you want to embed'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('videourl'); ?>" name="<?php echo $this->get_field_name('videourl'); ?>" type="text" value="<?php echo $videourl; ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width of embeded video'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height of embeded video'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('autostart'); ?>"><?php _e('autostart'); ?></label>

              <input id="<?php echo $this->get_field_id('autostart'); ?>" name="<?php echo $this->get_field_name('autostart'); ?>" type="checkbox" value="FALSE" <?php checked( 'TRUE', $autostart ); ?> />

          </p>
          <p>
              <label for="<?php echo $this->get_field_id('morelink'); ?>"><?php _e('Link for more Videos (defaults to category of video)'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('morelink'); ?>" name="<?php echo $this->get_field_name('morelink'); ?>" type="text" value="<?php echo $morelink; ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Text for more Videos link (defaults to see more videos on...)'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
          </p>

      <?php
      }
  }
add_action('widgets_init', create_function('', 'return register_widget("kith_videos_widget");'));
?>