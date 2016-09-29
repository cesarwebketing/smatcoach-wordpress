<?php
/**
* evo settings class
*/
class evo_settings_settings{
	function __construct($evcal_opt)	{
		$this->evcal_opt = $evcal_opt;
	}

	function content(){

		// google maps styles description
		$gmaps_desc = '<span class="evo_gmap_styles" data-url="'.AJDE_EVCAL_URL.'/assets/images/ajde_backender/"></span>';

		return apply_filters('eventon_settings_tab1_arr_content', array(
			array(
				'id'=>'evcal_001',
				'name'=>__('General Calendar Settings','eventon'),
				'display'=>'show',
				'tab_name'=>__('General Settings','eventon'),
				'top'=>'4',
				'fields'=> apply_filters('eventon_settings_general', array(
					array('id'=>'evcal_cal_hide','type'=>'yesno','name'=>__('Hide Calendar from front-end','eventon'),),
					array('id'=>'evcal_arrow_hide','type'=>'yesno','name'=>__('Hide Front-end arrow navigation','eventon'),),
					array('id'=>'evcal_cal_hide_past','type'=>'yesno','name'=>__('Hide past events for default calendar(s)','eventon'),'afterstatement'=>'evcal_cal_hide_past'),	
											
					array('id'=>'evcal_cal_hide_past','type'=>'begin_afterstatement'),
					array('id'=>'evcal_past_ev','type'=>'radio','name'=>__('Select a precise timing for the cut off time for past events','eventon'),'width'=>'full',
						'options'=>array(
							'local_time'=>__('Hide events past current local time','eventon'),
							'today_date'=>__('Hide events past today\'s date','eventon'))
					),
					array('id'=>'evcal_cal_hide_past','type'=>'end_afterstatement'),				
					array('id'=>'evcal_dis_conFilter','type'=>'yesno','name'=>__('Disable Content Filter','eventon'),'legend'=>__('This will disable to use of the_content filter on event details and custom field values.','eventon')),				
					
					array('id'=>'evo_usewpdateformat','type'=>'yesno','name'=>__('Use WP default Date format in eventON calendar','eventon'), 'legend'=>__('Select this option to use the default WP Date format through out eventON calendar. Default format: yyyy/mm/dd','eventon')),

					array('id'=>'evo_googlefonts','type'=>'yesno','name'=>__('Disable google web fonts','eventon'), 'legend'=>__('This will stop loading all google fonts used in eventon calendar.','eventon')),

					array('id'=>'evo_fontawesome','type'=>'yesno','name'=>__('Disable font awesome fonts','eventon'), 'legend'=>__('This will stop loading font awesome fonts in eventon calendar.','eventon')),
					
					array('id'=>'evo_schema','type'=>'yesno','name'=>__('Remove schema data from calendar','eventon'), 'legend'=>__('Schema microdata helps in google and other search engines find events in special event data format. With this option you can remove those microdata from showing up on front-end calendar.','eventon')),
				
					array('id'=>'evcal_css_head','type'=>'yesno','name'=>__('Write dynamic styles to header','eventon'), 'legend'=>__('If making changes to appearances dont reflect on front-end try this option. This will write those dynamic styles inline to page header','eventon')),
					
					array('id'=>'evcal_move_trash','type'=>'yesno','name'=>__('Auto move events to trash when the event date is past'), 'legend'=>__('This will move events to trash when the event end date is past current date')),

					
					//array('id'=>'evo_wpml','type'=>'yesno','name'=>'Activate WPML compatibility', 'legend'=>'This will activate WPML compatibility features.'),

					array('id'=>'evcal_header_format','type'=>'text','name'=>'Calendar Header month/year format. <i>(<b>Allowed values:</b> m = month name, Y = 4 digit year, y = 2 digit year)</i>' , 'default'=>'m, Y'),
					array('id'=>'evcal_perma_refresh','type'=>'customcode','code'=>'<a href="'.admin_url().'options-permalink.php" class="evo_admin_btn btn_secondary">Reset Permalinks</a>' ,),
			))),		
			
			array(
				'id'=>'evcal_005',
				'name'=>__('Google Maps API Settings','eventon'),
				'tab_name'=>__('Google Maps API','eventon'),
				'top'=>'4',
				'fields'=>array(
					array('id'=>'evcal_cal_gmap_api','type'=>'yesno','name'=>'Disable Google Maps API','legend'=>'This will stop gmaps API from loading on frontend and will stop google maps from generating on event locations.','afterstatement'=>'evcal_cal_gmap_api'),
					array('id'=>'evcal_cal_gmap_api','type'=>'begin_afterstatement'),
					array('id'=>'evcal_gmap_disable_section','type'=>'radio','name'=>'Select which part of Google gmaps API to disable','width'=>'full',
						'options'=>array(
							'complete'=>'Completely disable google maps',
							'gmaps_js'=>'Google maps javascript file only (If the js file is already loaded with another gmaps program)')
					),
					array('id'=>'evcal_cal_gmap_api','type'=>'end_afterstatement'),
					
					array('id'=>'evcal_gmap_scroll','type'=>'yesno','name'=>'Disable scrollwheel zooming on Google Maps','legend'=>'This will stop google maps zooming when mousewheel scrolled.'),
					
					array('id'=>'evcal_gmap_format', 'type'=>'dropdown','name'=>'Google maps display type:',
						'options'=>array(
							'roadmap'=>'ROADMAP Displays the normal default 2D',
							'satellite'=>'SATELLITE Displays photographic tiles',
							'hybrid'=>'HYBRID Displays a mix of photographic tiles and a tile layer',
						)),
					array('id'=>'evcal_gmap_zoomlevel', 'type'=>'dropdown','name'=>'Google starting zoom level:',
						'desc'=>'18 = zoomed in (See few roads), 7 = zoomed out. (See most of the country)',
						'options'=>array(
							'18'=>'18',
							'16'=>'16',
							'14'=>'14',
							'12'=>'12',
							'10'=>'10',
							'8'=>'8',
							'7'=>'7',
						)),
					array('id'=>'evcal_gmap_style', 'type'=>'dropdown','name'=>'Map Style',
						'desc'=>$gmaps_desc,
						'options'=>array(
							'default'=>'Default',
							'apple'=>'Apple Maps-esque',
							'avacado'=>'Avacado World',
							'bentley'=>'Bentley',
							'blueessence'=>'Blue Essence',
							'bluewater'=>'Blue Water',
							'hotpink'=>'Hot Pink',
							'muted'=>'Muted Monotone',
							'richblack'=>'Rich Black',
							'redalert'=>'Red Alert',
							'retro'=>'Retro',
							'shift'=>'Shift Worker',
						)),
			)),
			array(
				'id'=>'evcal_001a',
				'name'=>__('Calendar front-end Sorting and filtering options','eventon'),
				'tab_name'=>__('Sorting and Filtering','eventon'),
				'top'=>'4',
				'fields'=>array(
					array('id'=>'evcal_hide_sort','type'=>'yesno','name'=>'Hide Sort Bar on Calendar'),
					array('id'=>'evcal_sort_options', 'type'=>'checkboxes','name'=>'Event sorting options to show on Calendar <i>(Note: Event Date will be default sorting option that will be always on)</i>',
						'options'=>array(
							'title'=>'Event Main Title',
							'color'=>'Event Color',									
						)),
					array('id'=>'evcal_filter_options', 'type'=>'checkboxes','name'=>'Event filtering options to show on the calendar</i>',
						'options'=>$this->event_type_options()
					),
			)),
			array(
				'id'=>'evcal_002',
				'name'=>__('General Frontend Calendar Appearance','eventon'),
				'tab_name'=>__('Appearance','eventon'),
				'top'=>'40',
				'fields'=>$this->appearance()
			),
			array(
				'id'=>'evcal_004',
				'name'=>__('Custom Icons for Calendar','eventon'),
				'tab_name'=>__('Icons','eventon'),
				'top'=>'76',
				'fields'=> apply_filters('eventon_custom_icons', array(
					array('id'=>'fs_fonti2','type'=>'fontation','name'=>'EventCard Icons',
						'variations'=>array(
							array('id'=>'evcal__ecI', 'type'=>'color', 'default'=>'6B6B6B'),
							array('id'=>'evcal__ecIz', 'type'=>'font_size', 'default'=>'18px'),
						)
					),
					
					array('id'=>'evcal__fai_001','type'=>'icon','name'=>'Event Details Icon','default'=>'fa-align-justify'),
					array('id'=>'evcal__fai_002','type'=>'icon','name'=>'Event Time Icon','default'=>'fa-clock-o'),
					array('id'=>'evcal__fai_003','type'=>'icon','name'=>'Event Location Icon','default'=>'fa-map-marker'),
					array('id'=>'evcal__fai_004','type'=>'icon','name'=>'Event Organizer Icon','default'=>'fa-headphones'),
					array('id'=>'evcal__fai_005','type'=>'icon','name'=>'Event Capacity Icon','default'=>'fa-tachometer'),
					array('id'=>'evcal__fai_006','type'=>'icon','name'=>'Event Learn More Icon','default'=>'fa-link'),
					array('id'=>'evcal__fai_007','type'=>'icon','name'=>'Event Ticket Icon','default'=>'fa-ticket'),
					array('id'=>'evcal__fai_008','type'=>'icon','name'=>'Add to your calendar Icon','default'=>'fa-calendar-o'),
					array('id'=>'evcal__fai_008a','type'=>'icon','name'=>'Get Directions Icon','default'=>'fa-road'),
				))
			)
			// event top
			,array(
				'id'=>'evcal_004aa',
				'name'=>__('EventTop Settings (EventTop is an event row on calendar)','eventon'),
				'tab_name'=>__('EventTop','eventon'),
				'fields'=>array(
					array('id'=>'evcal_top_fields', 'type'=>'checkboxes','name'=>'Additional data fields for eventTop: <i>(NOTE: <b>Event Name</b> and <b>Event Date</b> are default fields)</i>',
							'options'=> apply_filters('eventon_eventop_fields', $this->eventtop_settings()),
					),
				)
			)
			// event card
			,array(
				'id'=>'evcal_004a',
				'name'=>__('EventCard Settings (EventCard is the full event details card)','eventon'),
				'tab_name'=>__('EventCard','eventon'),
				'fields'=>array(
					array('id'=>'evo_timeF','type'=>'yesno','name'=>'Allow universal event time format on eventCard','legend'=>'This will change the time format on eventCard to be a universal set format regardless of the month events span for.','afterstatement'=>'evo_timeF'),
						array('id'=>'evo_timeF','type'=>'begin_afterstatement'),
						array('id'=>'evo_timeF_v','type'=>'text','name'=>'Time Format', 'default'=>'F j(l) g:ia'),
						array('id'=>'evcal_api_mu_note','type'=>'note',
							'name'=>'Acceptable date/time values: php <a href="http://php.net/manual/en/function.date.php" target="_blank">date()</a> '),
						array('id'=>'evo_timeF','type'=>'end_afterstatement'),
					
					array('id'=>'evo_ics','type'=>'yesno','name'=>'Show ICS download to your calendar','legend'=>'This will allow users to download each event as ICS file which can be imported to their calendar of choice.','desc'=>'Once this is activated, make sure the field is saved in Rearrange order below.'),
					
					array('id'=>'evo_getdir','type'=>'yesno','name'=>'Show get directions to text field','legend'=>'This will add an input field to eventCard that will allow user to type in their address and get directions to event location in a new window.','desc'=>'Once this is activated, make sure the field is saved in Rearrange order below.'),
					
					array('id'=>'evo_morelass','type'=>'yesno','name'=>'Show full event description','legend'=>'If you select this option, you will not see More/less button on EventCard event description.'),
					
					array('id'=>'evo_opencard','type'=>'yesno','name'=>'Open all eventCards by default','legend'=>'This option will load the calendar with all the eventCards open by default and will not need to be clicked to slide down and see details.'),
					
					/*array('id'=>'evcal_tdate_format','type'=>'text','name'=>'EventCard Date/Time format.' , 'default'=>'F j (l)', 'legend'=>'Allowed values:<br/>M = Jan-Dec<br/>F = January-December <br/>j = 1-31 (date)<br/>S = st,nd,rd <br/>l = Sunday-Saturday<br/>D = Sun-Sat'),*/
					

					array('id'=>'evcal_sh001','type'=>'subheader','name'=>__('Featured Image','eventon')),
					array('id'=>'evo_ftimghover','type'=>'yesno','name'=>'Disable hover effect on featured image','legend'=>'Remove the hover moving animation effect from featured image on event.'),
					array('id'=>'evo_ftimgclick','type'=>'yesno','name'=>'Disable zoom effect on click','legend'=>'Remove the moving animation effect from featured image on click event.'),
					/*array('id'=>'evo_ftimg_fullheight','type'=>'yesno','name'=>'Show featured image at 100% height', ), -- removed 2.2.20*/

					array('id'=>'evo_ftimgheight','type'=>'text','name'=>'Minimize height for featured image (value in pixels)', 'default'=>'eg. 400'),
					array('id'=>'evo_ftimg_height_sty','type'=>'dropdown','name'=>'Featured image display style (On event load)', 'legend'=>'Select which display style you want to show the featured image on event card when event first load',
						'options'=> array(
							'minmized'=>'Minimized height',
							'100per'=>'100% Image height with stretch to fit',
							'full'=>'100% Image height with propotionate to calendar width'
					)),


					array('id'=>'evo_ftim_mag','type'=>'yesno','name'=>'Show magnifying glass over featured image','legend'=>'This will convert the mouse cursor to a magnifying glass when hover over featured image. <br/><br/><img src="'.AJDE_EVCAL_URL.'/assets/images/ajde_backender/cursor_mag.jpg"/>'),

					array('id'=>'evcal_sh001','type'=>'subheader','name'=>__('Location Image','eventon')),
					array('id'=>'evo_locimgheight','type'=>'text','name'=>__('Set event location image height (value in pixels)','eventon'), 'default'=>'eg. 400'),
					
					array('id'=>'evo_EVC_arrange', 'type'=>'customcode','code'=>$this->rearrange_code(), ),
				)
			),array(
				'id'=>'evcal_003',
				'name'=>__('Third Party API Support for Event Calendar','eventon'),
				'tab_name'=>__('Third Party APIs','eventon'),
				'top'=>'112',
				'fields'=>array(
					// eventbrite
					array('id'=>'evcal_s','type'=>'subheader','name'=>'EventBrite'),
					array('id'=>'evcal_sdd','type'=>'note','name'=>'<i>NOTE: As we have built our own <a href="http://www.myeventon.com/addons/event-tickets/" target="_blank">event Ticket addon</a> we are no longer adding additional features for eventbrite. Financially Event Ticket addon is a better option as you will NOT have to pay percentage of each ticket sale with EventTicket addon.</i>'),
					array('id'=>'evcal_evb_events','type'=>'yesno','name'=>'Enable EventBrite data fetching for calendar events','legend'=>'Once enabled, this will allow you to connect eventbrite to event calendar and populate event data such as event name, event location, ticket price for events, event capacity & link to buy ticket','afterstatement'=>'evcal_evb_events'),
					array('id'=>'evcal_evb_events','type'=>'begin_afterstatement'),
					array('id'=>'evcal_evb_api','type'=>'text','name'=>'EventBrite API Key'),
					array('id'=>'evcal_evb_api_note','type'=>'note','name'=>'(In order to get your eventbrite API key <a href=\'https://www.eventbrite.com/api/key/\' target=\'_blank\'>open this</a> and login to your eventbrite account, fill in the required information in this page and click "create key". Once approved, you will receive the API key.)'),
					array('id'=>'evcal_eb_hide','type'=>'end_afterstatement'),
					
					// meetup
					array('id'=>'evcal_s','type'=>'subheader','name'=>'Meetup'),
					array('id'=>'evcal_api_meetup','type'=>'yesno','name'=>'Enable Meetup data fetching for calendar events','legend'=>'Once enabled, this will allow your to connect meetup events and populate calendar events with meetup event data such as event name, event time, location, & meetup event url','afterstatement'=>'evcal_api_meetup'),
					array('id'=>'evcal_api_meetup','type'=>'begin_afterstatement'),
					array('id'=>'evcal_api_mu_key','type'=>'text','name'=>'Meetup API Key'),
					array('id'=>'evcal_api_mu_note','type'=>'note','name'=>'(In order to get your meetup API key, login to meetup and <a href=\'http://www.meetup.com/meetup_api/key/\' target=\'_blank\'>open this</a>.)'),
					array('id'=>'evcal_mu_settings','type'=>'end_afterstatement'),
					
					// paypal
					array('id'=>'evcal_s','type'=>'subheader','name'=>'Paypal'),
					array('id'=>'evcal_paypal_pay','type'=>'yesno','name'=>'Enable PayPal event ticket payments','afterstatement'=>'evcal_paypal_pay', 'legend'=>'This will allow you to add a paypal direct link to each event that will allow visitors to pay for event via paypal.'),
					array('id'=>'evcal_paypal_pay','type'=>'begin_afterstatement'),
					array('id'=>'evcal_pp_email','type'=>'text','name'=>'Your paypal email address to receive payments'),				
					array('id'=>'evcal_pp_cur','type'=>'dropdown','name'=>'Select your currency', 'options'=>evo_get_currency_codes() ),				
					array('id'=>'evcal_paypal_pay','type'=>'end_afterstatement'),
				)
			)
			// custom meta fields
			,array(
				'id'=>'evcal_009',
				'name'=>__('Custom Meta Data fields for events','eventon'),
				'tab_name'=>__('Custom Meta Data','eventon'),
				'fields'=>$this->custom_meta_fields()
			)
			// event categories
			,array(
				'id'=>'evcal_010',
				'name'=>__('EventType Categories','eventon'),
				'tab_name'=>__('Categories','eventon'),
				'fields'=>array(			

					array('id'=>'evcal_fcx','type'=>'note','name'=>'Use this to assign custom names for the event type taxonomies which you can use to categorize events. Note: Once you update these custom taxonomies refresh the page for the values to show up.'),
					array('id'=>'evcal_eventt','type'=>'text','name'=>'Custom name for Event Type Category #1',),
					array('id'=>'evcal_eventt2','type'=>'text','name'=>'Custom name for Event Type Category #2',),


					array('id'=>'evcal_fcx','type'=>'note','name'=>'In order to add additional event type categories make sure you activate them in order. eg. Activate #4 after you activate #3'),
					array('id'=>'evcal_ett_3','type'=>'yesno','name'=>'Activate Event Type Category #3','legend'=>'This will activate additional event type category.','afterstatement'=>'evcal_ett_3'),
					array('id'=>'evcal_ett_3','type'=>'begin_afterstatement'),
						array('id'=>'evcal_eventt3','type'=>'text','name'=>'Category Type Name'),
					array('id'=>'evcal_ett_3','type'=>'end_afterstatement'),

					array('id'=>'evcal_ett_4','type'=>'yesno','name'=>'Activate Event Type Category #4','legend'=>'This will activate additional event type category.','afterstatement'=>'evcal_ett_4'),
					array('id'=>'evcal_ett_4','type'=>'begin_afterstatement'),
						array('id'=>'evcal_eventt4','type'=>'text','name'=>'Category Type Name'),
					array('id'=>'evcal_ett_4','type'=>'end_afterstatement'),

					array('id'=>'evcal_ett_5','type'=>'yesno','name'=>'Activate Event Type Category #5','legend'=>'This will activate additional event type category.','afterstatement'=>'evcal_ett_5'),
					array('id'=>'evcal_ett_5','type'=>'begin_afterstatement'),
						array('id'=>'evcal_eventt5','type'=>'text','name'=>'Category Type Name'),
					array('id'=>'evcal_ett_5','type'=>'end_afterstatement'),
					
				)
			)
			// events paging
			,array(
				'id'=>'evcal_011',
				'name'=>__('Events Paging','eventon'),
				'tab_name'=>__('Events Paging','eventon'),
				'fields'=>array(			
					array('id'=>'evcal__note','type'=>'note','name'=>'This page will allow you to control templates and permalinks related to eventon event pages.'),
					
					array('id'=>'evo_event_archive_page_id','type'=>'dropdown','name'=>__('Select Events Page','eventon'), 'legend'=>__('If making changes to appearances dont reflect on front-end try this option. This will write those dynamic styles inline to page header','eventon'), 'options'=>$this->event_pages(), 'desc'=>'This will allow you to use this page with url slug /events/ as event archive page'),
					array('id'=>'evo_event_archive_page_template','type'=>'dropdown','name'=>__('Select Events Page Template','eventon'), 'options'=>$this->theme_templates()),
					
					array('id'=>'evo_event_slug','type'=>'text','name'=>__('EventOn Event Post Slug','eventon'), 'default'=>'events'),
				)
			),array(
				'id'=>'evcal_012',
				'name'=>__('Shortcode Settings','eventon'),
				'tab_name'=>__('ShortCodes','eventon'),
				'fields'=>array(			
					array('id'=>'evcal__note','type'=>'customcode','code'=>$this->content_shortcodes()),
					
					
				)
			)
			)
		);	
	}

		function eventtop_settings(){
			global $eventon;

			$num = evo_calculate_cmd_count($this->evcal_opt[1]);
			$_add_tax_count = evo_get_ett_count($this->evcal_opt[1]);
			$_tax_names_array = evo_get_ettNames($this->evcal_opt[1]);

			
			$arr = array(
				'time'=>__('Event Time (to and from)','eventon'),
				'location'=>__('Event Location Address','eventon'),
				'locationame'=>__('Event Location Name','eventon'),				
			);

			// additional taxonomies
			for($n=1; $n<= $_add_tax_count; $n++){
				$__tax_fields = 'eventtype'.($n==1?'':$n);
				$__tax_name = $_tax_names_array[$n];
				$arr[$__tax_fields]=__($__tax_name.' (Category #'.$n.')','eventon');
			}


			$arr['dayname']=__('Event Day Name (Only for one day events)','eventon');
			$arr['organizer']=__('Event Organizer','eventon');

			// add custom fields
			for($x=1; $x < ($num+1); $x++){
				if(!empty($this->evcal_opt[1]['evcal_af_'.$x])  && $this->evcal_opt[1]['evcal_af_'.$x]=='yes' && !empty($this->evcal_opt[1]['evcal_ec_f'.$x.'a1']) ){
					$arr['cmd'.$x] = $this->evcal_opt[1]['evcal_ec_f'.$x.'a1'];					
				}else{ break;}
			}

			return $arr;
		}
		function event_type_options(){
			$event_type_names = evo_get_ettNames($this->evcal_opt[1]);
			// event types category names		
			$ett_verify = evo_get_ett_count($this->evcal_opt[1] );
			$event_type_options['event_location'] = 'Event Location';
			$event_type_options['event_organizer'] = 'Event Organizer';
			for($x=1; $x< ($ett_verify+1); $x++){
				$ab = ($x==1)? '':'_'.$x;
				$event_type_options['event_type'.$ab] = $event_type_names[$x];
			}
			return $event_type_options;
		}
		function rearrange_code(){
			$rearrange_items = apply_filters('eventon_eventcard_boxes', array(
				'ftimage'=>'<p val="ftimage">'.__('Featured Image','eventon').'</p>',
				'eventdetails'=>'<p val="eventdetails">'.__('Event Details','eventon').'</p>',
				'timelocation'=>'<p val="timelocation">'.__('Time and Location','eventon').'</p>',
				'organizer'=>'<p val="organizer">'.__('Event Organizer','eventon').'</p>',
				'locImg'=>'<p val="locImg">'.__('Location Image','eventon').'</p>',
				'gmap'=>'<p val="gmap">'.__('Google Maps','eventon').'</p>',
				'learnmoreICS'=>'<p val="learnmoreICS">'.__('Learn More & Add to your calendar','eventon').'</p>',		
			));


			
			//get directions
			if(!empty($this->evcal_opt[1]['evo_getdir']) && $this->evcal_opt[1]['evo_getdir']=='yes')
				$rearrange_items['getdirection']='<p val="getdirection">'.__('Get Directions','eventon').'</p>';
			
			//eventbrite
			if(!empty($this->evcal_opt[1]['evcal_evb_events']) && $this->evcal_opt[1]['evcal_evb_events']=='yes')
				$rearrange_items['eventbrite']='<p val="eventbrite">'.__('eventbrite','eventon').'</p>';
				
			//paypal
			if(!empty($this->evcal_opt[1]['evcal_paypal_pay']) && $this->evcal_opt[1]['evcal_paypal_pay']=='yes')
				$rearrange_items['paypal']='<p val="paypal">'.__('Paypal','eventon').'</p>';
			
			// custom fields
			$_cmd_num = evo_calculate_cmd_count($this->evcal_opt[1]);
			for($x=1; $x<=$_cmd_num; $x++){
				if( !empty($this->evcal_opt[1]['evcal_ec_f'.$x.'a1']) && !empty($this->evcal_opt[1]['evcal_af_'.$x]) && $this->evcal_opt[1]['evcal_af_'.$x]=='yes')
					$rearrange_items['customfield'.$x] = '<p val="customfield'.$x.'">'.$this->evcal_opt[1]['evcal_ec_f'.$x.'a1'].'</p>';
			}

			//print_r($rearrange_items);
			$_saved_order = (!empty($this->evcal_opt[1]['evoCard_order']))? 
				array_filter(explode(',',$this->evcal_opt[1]['evoCard_order']))
				:null;
			
			
			//print_r($rearrange_items);
			//echo count($rearrange_items).' '.count($_saved_order);
			//print_r($_saved_order);
			// HTML
			$_rearrange_code = '<h4 class="acus_header">'.__('Re-arrange the order of eventCard event data boxes','eventon').'</h4>
				<input id="evoCard_order" name="evoCard_order" value="'.( (!empty($this->evcal_opt[1]['evoCard_order']))? $this->evcal_opt[1]['evoCard_order']:null).'" type="hidden"/>
				<div id="evoEVC_arrange_box">';
					
					// if an order array exists already
					if($_saved_order){
						
						foreach($_saved_order as $box){
							$_rearrange_code .= (array_key_exists($box, $rearrange_items))? $rearrange_items[$box]:null;
						}	
						
						// if there are new values in possible items add them to the bottom
						if(count($_saved_order) < count($rearrange_items)){
							
							foreach($rearrange_items as $f=>$v){
								$_rearrange_code .= (!in_array($f, $_saved_order))? $rearrange_items[$f]:null;
							}
						}
						
					}
					
					if(empty($rearrange_items) || empty($_saved_order)){	
						$implode = implode('',$rearrange_items);
						$_rearrange_code .=$implode;				
					}
					
				$_rearrange_code .='</div>';
			return $_rearrange_code;
		}
		function custom_meta_fields(){
			// reused array parts
			$__additions_009_1 = array('text'=>__('Single line Text','eventon'),'textarea'=>__('Multiple lines of text','eventon'), 'button'=>__('Button','eventon'));
			// additional custom data fields
			for($cm=1; $cm<11; $cm++){
				$__additions_009_a[$cm]= $cm;
			}

			// fields for each custom field
			$cmf_count = !empty($this->evcal_opt[1]['evcal_cmf_count'])? $this->evcal_opt[1]['evcal_cmf_count']: 3;
			$cmf_addition_x= array(array('id'=>'evcal__note','type'=>'note','name'=>'You can add upto 3 additional custom meta fields for each event using the below fields. <br/><b>NOTE: </b>Once new data field is activated go to <b>myEventon> Settings> EventCard</b> and rearrange the order of this new field and save changes for it to show on front-end. <br/>(* Required values)'),
					array('id'=>'evcal_cmf_count','type'=>'dropdown','name'=>'Number of Additional Custom Data Fields', 'options'=>$__additions_009_a, 'default'=>3),);

			for($cmf=0; $cmf< $cmf_count; $cmf++){
				$num = $cmf+1;

				$cmf_addition = array( 
					array('id'=>'evcal_af_'.$num,'type'=>'yesno','name'=>'Activate Additional Field #'.$num,'legend'=>'This will activate additional event meta field.','afterstatement'=>'evcal_af_'.$num.''),
					array('id'=>'evcal_af_'.$num,'type'=>'begin_afterstatement'),
					array('id'=>'evcal_ec_f'.$num.'a1','type'=>'text','name'=>'Field Name*'),
					array('id'=>'evcal_ec_f'.$num.'a2','type'=>'dropdown','name'=>'Content Type', 'options'=>$__additions_009_1),
					array('id'=>'evcal__fai_00c'.$num.'','type'=>'icon','name'=>'Icon','default'=>'fa-asterisk'),
					array('id'=>'evcal_ec_f'.$num.'a3','type'=>'yesno','name'=>'Hide this field from front-end calendar'),
					array('id'=>'evcal_af_'.$num,'type'=>'end_afterstatement')
				);

				$cmf_addition_x = array_merge($cmf_addition_x, $cmf_addition);
			}
			return $cmf_addition_x;
		}

	/**
	 * theme pages and templates
	 * @return  
	 */
		function event_pages(){
			$pages = new WP_Query(array('post_type'=>'page'));
			$_page_ar[]	='--';
			while($pages->have_posts()	){ $pages->the_post();								
				$page_id = get_the_ID();
				$_page_ar[$page_id] = get_the_title($page_id);
			}
			wp_reset_postdata();
			return $_page_ar;
		}
		function theme_templates(){
			// get all available templates for the theme
			$templates = get_page_templates();
			$_templates_ar['archive-ajde_events.php'] = 'Default Eventon Template';
			$_templates_ar['page.php'] = 'Default Page Template';
		   	foreach ( $templates as $template_name => $template_filename ) {
		       $_templates_ar[$template_filename] = $template_name;
		   	}
		   	return $_templates_ar;
		}

	function content_shortcodes(){

		ob_start();
		?>
			<p>Use the "Generate shortcode" button to open lightbox shortcode generator to create your desired calendar shortcode.</p><br/>
			
			<a id="evo_shortcode_btn" class="eventon_popup_trig evo_admin_btn btn_prime" title="eventON Shortcode generator" href="#" data-textbox='evo_set_shortcodes'>[ ] Generate shortcode</a><br/>
			<p id='evo_set_shortcodes'></p>

			<p style='padding-top:10px'><b>Other common shortcodes</b></p>
			<p>[add_eventon] -- Default month calendar</p>
			<p>[add_eventon_list number_of_months="5" hide_empty_months="yes" ] -- 5 months events list with empty months hidden from view</p>
			<p>[add_eventon_list number_of_months="5" month_incre="-5" ] -- Show list of 5 past months</p>

		<?php

		// throw shortcode popup codes
		eventon_shortcode_pop_content();

		return ob_get_clean();
		
	}

		function appearance_theme_selector(){
			
			ob_start();

				echo  '<h4 class="acus_header">'.__('Calendar Themes','eventon').'</h4>
				<input id="evo_cal_theme" name="evo_cal_theme" value="'.( (!empty($this->evcal_opt[1]['evo_cal_theme']))? $this->evcal_opt[1]['evo_cal_theme']:null).'" type="hidden"/>
				<div id="evo_theme_selection">';

				// scan for themes
				$dir = AJDE_EVCAL_PATH.'/themes/';				
				$a = scandir($dir);
				
				$themes =$the = '';
				foreach($a as $file){
					if($file!= '.' && $file!= '..'){
						$base = basename($file,'.php');
						$themes[$base] = $file;
						if(file_exists($dir.$file)){
							include_once($dir.$file);
							$the[] = array('name'=>$base, 'content'=>$theme);
						}
					}
				}


					echo "<p id='evo_themejson' style='display:none'>".json_encode($the)."</p>";
					$evo_theme_current =  !empty($this->evcal_opt[1]['evo_theme_current'])? $this->evcal_opt[1]['evo_theme_current']: 'default';

				?>
					<p class='evo_theme_selection'>Current Theme: <b><select name='evo_theme_current'>
						<option value='default'>Default</option>
						<?php
							if(!empty($themes)){
								foreach($themes as $base=>$theme){
									echo "<option value='{$base}' ". ($base==$evo_theme_current? "selected='selected'":null).">".$base.'</option>';
								}
							}
						?>
					</select></b>
						<span class='evo_theme'>
							<span name='evcal__fc2' style='background-color:#<?php echo $this->colr('evcal__fc2','ABABAB' );?>' data-default='ABABAB'></span>
							<span name='evcal_header1_fc' style='background-color:#<?php echo $this->colr('evcal_header1_fc','C6C6C6' );?>' data-default='C6C6C6'></span>
							<span name='evcal__bgc4' style='background-color:#<?php echo $this->colr('evcal__bgc4','fafafa' );?>' data-default='fafafa'></span>
							<span name='evcal__fc3' style='background-color:#<?php echo $this->colr('evcal__fc3','6B6B6B' );?>' data-default='6B6B6B'></span>
							<span name='evcal__jm010' style='background-color:#<?php echo $this->colr('evcal__jm010','e2e2e2' );?>' data-default='e2e2e2'></span>
						</span>
					</p>
					
					<p style='clear:both'><i>Themes are in <strong>Beta stage</strong> and we are working on it & addin more themes.</i><br/><i>You can now change <strong>Google Maps Style</strong> to match the theme from <strong><a href='<?php echo admin_url();?>admin.php?page=eventon'>EventON Settings &rarr; Google Maps API.</a></strong></i></p>
					<p style='clear:both'><i><strong>NOTE:</strong> After changing theme make sure to click "save changed"</i></p>
		
				<?php

				echo '</div>';

			return ob_get_clean();
		}
		private function colr($var, $def){
			return (!empty($this->evcal_opt[1][$var]))? $this->evcal_opt[1][$var]: $def;
		}
	/**
	 * appearance array section of the settings
	 * @return  
	 */
	public function appearance(){
		return apply_filters('eventon_appearance_add', 
			array(
				array('id'=>'evo_notice_1','type'=>'notice','name'=>__('Once you make changes to appearance make sure to clear browser and website cache to see results.','eventon'))
				
				,array('id'=>'evoapp_code_1', 'type'=>'customcode','code'=>$this->appearance_theme_selector(), )
				,array('id'=>'fc_mcolor','type'=>'multicolor','name'=>'Multiple colors',
					'variations'=>array(
						array('id'=>'evcal_hexcode', 'default'=>'206177', 'name'=>'Primary Calendar Color'),
						array('id'=>'evcal_header1_fc', 'default'=>'C6C6C6', 'name'=>'Header Month/Year text color'),
						array('id'=>'evcal__fc2', 'default'=>'ABABAB', 'name'=>'Calendar Date color'),
					)
				),
				array('id'=>'evcal_font_fam','type'=>'text','name'=>'Primary Calendar Font family <i>(Note: type the name of the font that is supported in your website. eg. Arial)</i>'),

				

				// Calendar Header
				array('id'=>'evcal_fcx','type'=>'hiddensection_open','name'=>'Calendar Header', 'display'=>'none'),
				array('id'=>'fs_sort_options','type'=>'fontation','name'=>'Sort Options Text',
					'variations'=>array(
						array('id'=>'evcal__sot', 'name'=>'Default State', 'type'=>'color', 'default'=>'B8B8B8'),
						array('id'=>'evcal__sotH', 'name'=>'Hover State', 'type'=>'color', 'default'=>'d8d8d8'),
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Jump Months Button',
					'variations'=>array(
						array('id'=>'evcal__jm001', 'name'=>'Text Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm002', 'name'=>'Background Color', 'type'=>'color', 'default'=>'d3d3d3'),
						array('id'=>'evcal__jm001H', 'name'=>'Text Color (Hover)', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm002H', 'name'=>'Background Color (Hover)', 'type'=>'color', 'default'=>'d3d3d3'),						
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Month/Year Buttons',
					'variations'=>array(
						array('id'=>'evcal__jm003', 'name'=>'Text Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm004', 'name'=>'Background Color', 'type'=>'color', 'default'=>'ECECEC'),
						array('id'=>'evcal__jm003H', 'name'=>'Text Color (Hover)', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm004H', 'name'=>'Background Color (Hover)', 'type'=>'color', 'default'=>'c3c3c3'),							
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Month/Year Buttons: Current',
					'variations'=>array(
						array('id'=>'evcal__jm006', 'name'=>'Text Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm007', 'name'=>'Background Color', 'type'=>'color', 'default'=>'CFCFCF'),
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Month/Year Buttons: Active',
					'variations'=>array(
						array('id'=>'evcal__jm008', 'name'=>'Text Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm009', 'name'=>'Background Color', 'type'=>'color', 'default'=>'888888'),
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Month/Year Label Text',
					'variations'=>array(
						array('id'=>'evcal__jm005', 'name'=>'Text Color', 'type'=>'color', 'default'=>'6e6e6e'),							
					)
				),array('id'=>'fs_calhead','type'=>'fontation','name'=>'Arrow Circle',
					'variations'=>array(
						array('id'=>'evcal__jm010', 'name'=>'Line Color', 'type'=>'color', 'default'=>'e2e2e2'),
						array('id'=>'evcal__jm011', 'name'=>'Background Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal__jm010H', 'name'=>'Line Color (Hover)', 'type'=>'color', 'default'=>'e2e2e2'),
						array('id'=>'evcal__jm011H', 'name'=>'Background Color (Hover)', 'type'=>'color', 'default'=>'ededed'),
						array('id'=>'evcal__jm01A', 'name'=>'The arrow color', 'type'=>'color', 'default'=>'e2e2e2'),
						array('id'=>'evcal__jm01AH', 'name'=>'The arrow color (Hover)', 'type'=>'color', 'default'=>'ffffff'),
					)
				),				
				array('id'=>'evcal_ftovrr','type'=>'hiddensection_close'),


				// event top
				array('id'=>'evcal_fcx','type'=>'hiddensection_open','name'=>'EventTop Styles', 'display'=>'none'),
					array('id'=>'evcal__fc3','type'=>'color','name'=>'Event Title font color', 'default'=>'6B6B6B'),
					array('id'=>'evcal__fc3st','type'=>'color','name'=>'Event Sub Title font color', 'default'=>'6B6B6B'),
					array('id'=>'evcal__fc6','type'=>'color','name'=>'Text under event title (on EventTop. Eg. Time, location etc.)','default'=>'8c8c8c'),
					array('id'=>'evcal__fc7','type'=>'color','name'=>'Category title color (eg. Event Type)','default'=>'c8c8c8'),
					array('id'=>'evcal__evcbrb0','type'=>'color','name'=>'Event Top Border Color', 'default'=>'e5e5e5'),		
					array('id'=>'fs_fonti','type'=>'fontation','name'=>'Background Color',
						'variations'=>array(
							array('id'=>'evcal__bgc4', 'name'=>'Default State', 'type'=>'color', 'default'=>'fafafa'),
							array('id'=>'evcal__bgc4h', 'name'=>'Hover State', 'type'=>'color', 'default'=>'f4f4f4'),
						)
					),
				array('id'=>'evcal_fcx','type'=>'hiddensection_close',),
				

				// eventCard Styles
				array('id'=>'evcal_fcxx','type'=>'hiddensection_open','name'=>'EventCard Styles', 'display'=>'none'),
				array('id'=>'fs_fonti1','type'=>'fontation','name'=>'Section Title Text',
					'variations'=>array(
						array('id'=>'evcal__fc4', 'type'=>'color', 'default'=>'6B6B6B'),
						array('id'=>'evcal_fs_001', 'type'=>'font_size', 'default'=>'18px'),
					)
				),
				array('id'=>'evcal__fc5','type'=>'color','name'=>'General Font Color', 'default'=>'656565'),
				array('id'=>'evcal__bc1','type'=>'color','name'=>'Event Card Background Color', 'default'=>'eaeaea', 'rgbid'=>'evcal__bc1_rgb'),			
				array('id'=>'evcal__bc1H','type'=>'color','name'=>'Event Card Background Color (Hover on clickable section)', 'default'=>'d8d8d8'),			
				array('id'=>'evcal__evcbrb','type'=>'color','name'=>'Event Card Border Color', 'default'=>'cdcdcd'),

				// get direction fiels
				array('id'=>'evcal_fcx','type'=>'subheader','name'=>'Get Directions Field'),
				array('id'=>'fs_fonti3','type'=>'fontation','name'=>'Get Directions',
					'variations'=>array(
						array('id'=>'evcal_getdir_001', 'name'=>'Background Color', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal_getdir_002', 'name'=>'Text Color', 'type'=>'color', 'default'=>'888888'),
						array('id'=>'evcal_getdir_003', 'name'=>'Button Icon Color', 'type'=>'color', 'default'=>'858585'),
					)
				),			

				array('id'=>'evcal_fcx','type'=>'subheader','name'=>'Buttons'),
				array('id'=>'fs_fonti3','type'=>'fontation','name'=>'Button Color',
					'variations'=>array(
						array('id'=>'evcal_gen_btn_bgc', 'name'=>'Default State', 'type'=>'color', 'default'=>'237ebd'),
						array('id'=>'evcal_gen_btn_bgcx', 'name'=>'Hover State', 'type'=>'color', 'default'=>'237ebd'),
					)
				),array('id'=>'fs_fonti4','type'=>'fontation','name'=>'Button Text Color',
					'variations'=>array(
						array('id'=>'evcal_gen_btn_fc', 'name'=>'Default State', 'type'=>'color', 'default'=>'ffffff'),
						array('id'=>'evcal_gen_btn_fcx', 'name'=>'Hover State', 'type'=>'color', 'default'=>'ffffff'),
					)
				),
				array('id'=>'fs_fonti5','type'=>'fontation','name'=>'Close Button Color',
					'variations'=>array(
						array('id'=>'evcal_closebtn', 'name'=>'Default State', 'type'=>'color', 'default'=>'eaeaea'),
						array('id'=>'evcal_closebtnx', 'name'=>'Hover State', 'type'=>'color', 'default'=>'c7c7c7'),
					)
				),
				array('id'=>'evcal_fcx','type'=>'hiddensection_close',),

				// featured events
				array('id'=>'evcal_fcx','type'=>'subheader','name'=>'Featured Events'),
				array('id'=>'evo_fte_override','type'=>'yesno','name'=>'Override featured event color','legend'=>'This will override the event color you chose for featured event with a different color.','afterstatement'=>'evo_fte_override'),
				array('id'=>'evo_fte_override','type'=>'begin_afterstatement'),
					array('id'=>'evcal__ftec','type'=>'color','name'=>'Featured event left bar color', 'default'=>'ca594a'),
				array('id'=>'evcal_ftovrr','type'=>'end_afterstatement'),
			)
		);
	}
}
