<?php
/** 
 * Helper functions to be used by eventon or its addons
 * front-end only
 *
 * @version 0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class evo_helper{

	/**
	 * create a custom post withi n eventon
	 * @param  $args array post_status, post_type, and other jazz
	 */
	function create_posts($args){


		if(!empty($args) && is_array($args)){
			$valid_type = (function_exists('post_type_exists') &&  post_type_exists($args['post_type']));

			if(!$valid_type)
				return false;

			$__post_content = !empty($_POST['post_content'])? $_POST['post_content']: $args['post_content'];
			$__post_content = (!empty($__post_content))?
		        	wpautop(convert_chars(stripslashes($__post_content))): null;

		    // author id
		    $current_user = wp_get_current_user();
	        $author_id =  (($current_user instanceof WP_User)) ? $current_user->ID : $args['author_id'];

		    $new_post = array(
	            'post_title'   => wp_strip_all_tags($args['post_title']),
	            'post_content' => $__post_content,
	            'post_status'  => $args['post_status'],
	            'post_type'    => $args['post_type'],
	            'post_name'    => sanitize_title($args['post_title']),
	            'post_author'  => $author_id,
	        );

		    return wp_insert_post($new_post);

		}else{
			return false;
		}

	}


	function create_custom_meta($post_id, $field, $value){
		add_post_meta($post_id, $field, $value);
	}
}