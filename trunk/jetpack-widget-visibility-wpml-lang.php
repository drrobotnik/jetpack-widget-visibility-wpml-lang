<?php /**
 * Plugin Name: Jetpack Widget Visibility Additional Fields - WPML Language
 * Plugin URI: http://caavadesign.com
 * Description: Add the ability to add WPML language options to jetpacks visibility widget
 * Version: 1.0.0
 * Author: Brandon lavigne
 * Author URI: http://caavadesign.com
 * License: GPL2
 */

function jetpack_widget_visibility_wpml_lang_condition_major( $rule ) { ?>
<option value="wpml_lang" <?php selected( "wpml_lang", $rule['major'] ); ?>><?php esc_html_e( 'WPML Language', 'jetpack' ); ?></option>
<?php }

function jetpack_widget_visibility_wpml_lang_condition_minor( $rule ) { 
	global $sitepress;
	$languages = $sitepress->get_active_languages();

	foreach ($languages as $language_code => $value) { ?>
	<option value="<?php echo $language_code; ?>" <?php selected( $language_code, $rule['minor'] ); ?>><?php esc_html_e( $value['native_name'], 'jetpack' ); ?></option><?php
	}
}


function jetpack_widget_visibility_wpml_lang_filter_widget( $condition_result, $rule ) {
	if( 'wpml_lang' == $rule['major']) {

		if( ICL_LANGUAGE_CODE == $rule['minor'] ) {
			$condition_result = true;
		} else {
			$condition_result = false;
		}
	}

	return $condition_result;
}


add_filter( 'widget_visibility_filter_widget', 'jetpack_widget_visibility_wpml_lang_filter_widget', 11, 2 );

add_action( 'widget_visibility_condition_major', 'jetpack_widget_visibility_wpml_lang_condition_major' );
add_action( 'widget_visibility_condition_minor', 'jetpack_widget_visibility_wpml_lang_condition_minor' );