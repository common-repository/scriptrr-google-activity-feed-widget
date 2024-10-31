<?php
/*
Plugin Name: Scriptrr Google + Activity Feed widget
Plugin URI: http://plus.scriptrr.com/feeds.html
Description: Google Plus Activity Feed Widget allows users to add plugin on their blog or website to explore latest posts / feeds on Google + Profile.
Author: Sandeep Verma
Version: 0.7.1
Author URI: http://blog.svnlabs.com
Other: Plus.scriptrr.com is a tool to generate plugin/widget for Google + Activity Feed. Plus.scriptrr.com free, it does not require your personal information. Plus.scriptrr.com is third party product for widgets. 

*/


// Put functions into one big function we'll call at the plugins_loaded
// action. This ensures that all required plugin functions are defined.
function widget_scriptrr_google_plus_activity_feed_widget_init() {

	// Check for the required plugin functions. This will prevent fatal
	// errors occurring when you deactivate the dynamic-sidebar plugin.
	if ( !function_exists('register_sidebar_widget') )
		return;

	// This is the function that outputs our little Google search form.
	function widget_scriptrr_google_plus_activity_feed_widget($args) {
		
		// $args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys. Default tags: li and h2.
		extract($args);
		
		
		// Each widget can store its own options. We keep strings here.
		$options = get_option('widget_scriptrr_google_plus_activity_feed_widget');
		$userid = $options['userid'];
		$width = $options['width'];
		$height = $options['height'];
		$host = $options['host'];
		$links = $options['links'];
		$color = $options['color'];
		$title = ($options['title'] != "") ? $before_title.$options['title'].$after_title : "";  
		$widget = html_entity_decode($options['widget']);
		
		// These lines generate our output. Widgets can be very complex
		// but as you can see here, they can also be very, very simple.
		//echo $before_widget . $before_title . $title . $after_title;
		

			 
		echo $before_widget;
		echo $title;
		echo $widget;
		echo $after_widget;
	
	}

	// This is the function that outputs the form to let the users edit
	// the widget's title. It's an optional feature that users cry for.
	function widget_scriptrr_google_plus_activity_feed_widget_control() {

		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_scriptrr_google_plus_activity_feed_widget');
		
		
		if ( !is_array($options) )
			$options = array('title'=>'Google Plus Activity Feed Widget', 
				
				'userid' => '109726496391447539762',
				'width' => '220',
				'height' => '400',
				'host' => 'plus.scriptrr.com',
				'color' => 'c2c2c2',
				'links' => '0',
				
			);
			
			
		if ( $_POST['scriptrr_google_plus_activity_feed_widget-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			
			$options['userid'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-userid']));
			$options['width'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-width']));
			$options['height'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-height']));
			$options['host'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-host']));
			
			$options['color'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-color']));
			//$options['links'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-links']));
			$options['links'] = 0;
			
						

			$options['title'] = strip_tags(stripslashes($_POST['scriptrr_google_plus_activity_feed_widget-title']));
			$options['widget'] = '<iframe src="http://plus.scriptrr.com/feeds/feeds.php?plusid='.$options['userid'].'&host='.$options['host'].'&height='.$options['height'].'&width='.($options['width']-10).'&color='.$options['color'].'&links='.$options['links'].'" frameborder="0" scrolling="no" height="'.$options['height'].'" width="'.$options['width'].'"></iframe>';			
			
			
			//  echo $result;
           
			
			update_option('widget_scriptrr_google_plus_activity_feed_widget', $options);
		}

		// Be sure you format your options to be valid HTML attributes.
		
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$userid = htmlspecialchars($options['userid'], ENT_QUOTES);
		$width = htmlspecialchars($options['width'], ENT_QUOTES);
		$height = htmlspecialchars($options['height'], ENT_QUOTES);
		$host = htmlspecialchars($options['host'], ENT_QUOTES);
		
		$color = htmlspecialchars($options['color'], ENT_QUOTES);
		$links = htmlspecialchars($options['links'], ENT_QUOTES);

		
		// Here is our little form segment. Notice that we don't need a
		// complete form. This will be embedded into the existing form.

		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-title">' . __('Title:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-title" name="scriptrr_google_plus_activity_feed_widget-title" type="text" value="'.$title.'" /></label></p>';

		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-userid">' . __('Google+ ID:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-userid" name="scriptrr_google_plus_activity_feed_widget-userid" type="text" value="'.$userid.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-width">' . __('Width:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-width" name="scriptrr_google_plus_activity_feed_widget-width" type="text" value="'.$width.'" /></label></p>';
		
		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-height">' . __('Height:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-height" name="scriptrr_google_plus_activity_feed_widget-height" type="text" value="'.$height.'" /></label></p>';
		
		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-host">' . __('Domain:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-host" name="scriptrr_google_plus_activity_feed_widget-host" type="text" value="'.$host.'" /></label></p>';
		
		
		echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-color">' . __('Color:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-color" name="scriptrr_google_plus_activity_feed_widget-color" type="text" value="'.$color.'" /></label><br>(color code like c2c2c2)</p>';
		
		
		//echo '<p style="text-align:right;"><label for="scriptrr_google_plus_activity_feed_widget-links">' . __('Social Links:', 'widgets') . ' <input style="width: 200px;" id="scriptrr_google_plus_activity_feed_widget-links" name="scriptrr_google_plus_activity_feed_widget-links" type="text" value="'.$links.'" /></label><br>(1=yes/0=no)</p>';
		

		echo '<input type="hidden" id="scriptrr_google_plus_activity_feed_widget-submit" name="scriptrr_google_plus_activity_feed_widget-submit" value="1" />';
	}
	
	// This registers our widget so it appears with the other available
	// widgets and can be dragged and dropped into any active sidebars.
	register_sidebar_widget(array('Scriptrr Google + Activity Feed', 'widgets'), 'widget_scriptrr_google_plus_activity_feed_widget');

	// This registers our optional widget control form. Because of this
	// our widget will have a button that reveals a 300x100 pixel form.
	register_widget_control(array('Scriptrr Google + Activity Feed', 'widgets'), 'widget_scriptrr_google_plus_activity_feed_widget_control', 300, 200);
}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'widget_scriptrr_google_plus_activity_feed_widget_init');

?>