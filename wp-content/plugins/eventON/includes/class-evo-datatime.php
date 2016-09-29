<?php
/**
 * Eventon date time class.
 *
 * @class 		EVO_generator
 * @version		2.2.20
 * @package		EventON/Classes
 * @category	Class
 * @author 		AJDE
 */

class evo_datetime{
		
	/**	Construction function	 */
		public function __construct(){

		}

	/*
		input: event post meta, repeat interval, start or end time(var)
		ouput: interval corrected time
	*/
	public function get_int_correct_event_time($post_meta, $repeat_interval, $time='start'){

		if(!empty($post_meta['repeat_intervals']) && $repeat_interval>0){
			$intervals = unserialize($post_meta['repeat_intervals'][0]);
			return ($time=='start')? $intervals[$repeat_interval][0]:$intervals[$repeat_interval][1];
		}else{
			return ($time=='start')? $post_meta['evcal_srow'][0]:$post_meta['evcal_erow'][0];
		}
	}

}