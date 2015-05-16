<?php 
/**
* SP FRAMEWORK FILE - DO NOT EDIT!
* 
* custom menu walker
******************************************************************/

// custom walker class for nav menus
class sp_nav_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		if ( class_exists( 'WP_eCommerce' ) ) {
			$cat_width = get_option('category_image_width');
			$cat_height = get_option('category_image_height');
		}
		
		if ( class_exists( 'woocommerce' ) ) {
			$cat_width = 205;
			$cat_height = 85;
		}

		global $wp_query, $wpdb;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' data-rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= '<span>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.'</span>';

			$sql = "SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = {$item->ID} AND meta_key = '_menu_item_object_id'";
			$object_id = $wpdb->get_var($sql);
			
			if ( class_exists( 'WP_eCommerce' ) ) {
				if ( isset( $object_id ) ) {
					$sql = "SELECT meta_value FROM {$wpdb->prefix}wpsc_meta WHERE object_id = {$object_id} AND meta_key = 'image'"; 
					$image_src = $wpdb->get_var($sql);
				}
			}
			
			if ( class_exists( 'woocommerce' ) ) {
				$sql = "SELECT meta_value FROM {$wpdb->prefix}woocommerce_termmeta WHERE woocommerce_term_id = {$object_id} AND meta_key = 'thumbnail_id'"; 
				$image_src = $wpdb->get_var($sql);
			}
			
			$sql = "SELECT meta_id FROM {$wpdb->prefix}postmeta WHERE post_id = {$item->ID} AND meta_key = '_menu_item_menu_item_parent' AND meta_value = '0'";
			if ($wpdb->get_var($sql) != null) {
				if ( class_exists( 'WP_eCommerce' ) ) {
					if ( $image_src ) { 
						$item_output .= '<img src="' . sp_timthumb_format( 'footer_menu', sp_check_ms_image( WPSC_CATEGORY_URL . $image_src ), $cat_width, $cat_height ).'" alt="Footer Category Menu" class="cat-image" />';
					} else {
						$item_output .= '<img src="' . sp_timthumb_format( 'footer_menu', get_template_directory_uri().'/images/no-product-image.jpg', $cat_width, $cat_height ).'" alt="Footer Category Menu" class="cat-image" />';
					}
				}
				if ( class_exists( 'woocommerce' ) ) { 					
					if ( $image_src ) { 
						$image_src = wp_get_attachment_image_src( $image_src );
						$item_output .= '<img src="' . sp_timthumb_format( 'footer_menu', $image_src[0], $cat_width, $cat_height ) . '" alt="Footer Category Menu" class="cat-image" />';
					} else {
						$item_output .= '<img src="' . sp_timthumb_format( 'footer_menu', get_template_directory_uri().'/images/no-product-image.jpg', $cat_width, $cat_height ) . '" alt="Footer Category Menu" class="cat-image" />';
					}
				}
			}
			
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	  function end_el(&$output, $item, $depth) {
		  $output .= "</li>\n";
	  }

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// list pages for menu if dynamic primary menu function does not exist
if (!function_exists('header_menu')) :
	function header_menu(){ ?>
           <p style="color:blue;margin:20px 0;font-size:16px;display:block;">Please setup your menu items by going to your Wordpress backend "appearance/menus".</p>
	<?php }
endif;
// list pages for menu if dynamic secondary menu function does not exist
if (!function_exists('footer_menu')) :
	function footer_menu(){ ?>
			<p style="color:blue;margin:20px 0;font-size:16px;display:block;">Please setup your menu items by going to your Wordpress backend "appearance/menus".</p>
	<?php }
endif;

?>