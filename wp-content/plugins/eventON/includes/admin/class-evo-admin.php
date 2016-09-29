<?php
/**
 * all wp-admin classes
 *
 * @author 		AJDE
 * @category 	Admin
 * @package 	eventon/Admin
 * @version     2.2.17
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'evo_admin' ) ) :

/** evo_admin Class */
class evo_admin {

	private $class_name;
	/** Constructor */
	public function __construct() {
		
	}

	function get_image($size='', $placeholder=true){
		global $postid;

		$size = (!empty($size))? $size: 'thumbnail';

		$thumb = get_post_thumbnail_id($postid);

		if(!empty($thumb)){
			$img = wp_get_attachment_image_src($thumb, $size);
			return $img[0];
		}else if($placeholder){
			return AJDE_EVCAL_URL.'/assets/images/placeholder.png';
		}else{
			return false;
		}
	}

	function get_color($pmv=''){
		if(!empty($pmv['evcal_event_color'])){
			if( strpos($pmv['evcal_event_color'][0], '#') !== false ){
				return $pmv['evcal_event_color'][0];
			}else{
				return '#'.$pmv['evcal_event_color'][0];
			}
		}else{
			$opt = get_option('evcal_options_evcal_1');
			$cl = (!empty($opt['evcal_hexcode']))? $opt['evcal_hexcode']: '206177';
			return '#'.$cl;
		}
	}

	public function addon_exists($slug){
		$addons = get_option('eventon_addons');
		return (!empty($addons) && array_key_exists($slug, $addons))? true: false;
	}
	
}

endif;