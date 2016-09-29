<?php
/**
 * Event Top section
 * process content as html output
 * @since  eventon 2.2.23
 * @version  0.1
 */
function eventon_get_eventtop_print($array, $evOPT, $evOPT2){
	
	$OT = '';
	$_additions = apply_filters('evo_eventtop_adds' , array());

	foreach($array as $element =>$elm){

		// convert to an object
		$object = new stdClass();
		foreach ($elm as $key => $value){
			$object->$key = $value;
		}

		$boxname = (in_array($element, $_additions))? $element: null;

		switch($element){
			case has_filter("eventon_eventtop_{$boxname}"):
				$helpers = array(
					'evOPT'=>$evOPT,
					'evoOPT2'=>$evOPT2,
				);

				$OT.= apply_filters("eventon_eventtop_{$boxname}", $object, $helpers);	
			break;
			case 'ft_img':
				$OT.= "<span class='ev_ftImg' style='background-image:url(".$object->url.")'></span>";
			break;
			case 'day_block':

				$OT.="<span class='evcal_cblock' data-bgcolor='".$object->color."' data-smon='".$object->start['F']."' data-syr='".$object->start['Y']."'><em class='evo_date' >".$object->day_name.$object->html['html_date'].'</em>';
				$OT.="<em class='evo_time'>".$object->html['html_time']."</em>";
				$OT.= "<em class='clear'></em></span>";

			break;
			case 'titles':
				$OT.= "<span class='evcal_desc evo_info ". ( $object->yearlong?'yrl':null)."' {$object->loc_vars} ><span class='evcal_desc2 evcal_event_title' itemprop='name'>".$object->title."</span>";
				if($object->subtitle)
					$OT.= "<span class='evcal_event_subtitle' >".$object->subtitle."</span>";
			break;

			case 'belowtitle':
				$OT.= "<span class='evcal_desc_info' >";

				// time
				if($object->fields_ && in_array('time',$object->fields))
					$OT.= "<em class='evcal_time'>".$object->html['html_fromto']."</em> ";
				//location
				if($object->fields_ && in_array('location',$object->fields))
					$OT.=$object->location;

				//location name
				if($object->fields_ && in_array('locationame',$object->fields) && $object->locationname)
					$OT.='<em class="evcal_location event_location_name">'.$object->locationname.'</em>';

				$OT.="</span>";
				$OT.="<span class='evcal_desc3'>";

				//organizer
				if($object->fields_ && in_array('organizer',$object->fields))
					$OT.="<em class='evcal_oganizer'><i>".( eventon_get_custom_language( $evOPT2,'evcal_evcard_org', 'Event Organized By')  ).':</i> '.$object->evvals['evcal_organizer'][0]."</em>";
				//event type
				if($object->tax)
					$OT.= $object->tax;

				// custom fields
				for($x=1; $x<$object->cmdcount+1; $x++){
					if($object->fields_ && in_array('cmd'.$x,$object->fields) 
						&& !empty($object->evvals['_evcal_ec_f'.$x.'a1_cus'])){

						$def = $evOPT['evcal_ec_f'.$x.'a1']; // default custom meta field name
						$i18n_nam = eventon_get_custom_language( $evOPT2,'evcal_cmd_'.$x, $def);

						$OT.= ( ($x==1)? "<b class='clear'></b>":null )."<em class='evcal_cmd'><i>".$i18n_nam.':</i> '.$object->evvals['_evcal_ec_f'.$x.'a1_cus'][0]."</em> ";
					}
				}
			break;

			case 'close1':
				$OT.="</span>";// span.evcal_desc3
			break;

			case 'close2':
				$OT.= "</span>";// span.evcal_desc 
				$OT.="<em class='clear'></em>";
			break;
		}
	}	

	return $OT;
}


?>