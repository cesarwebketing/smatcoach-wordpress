<?php
/**
 * Functions for the settings page in admin.
 *
 * The settings page contains options for the EventON plugin - this file contains functions to display
 * and save the list of options.
 *
 * @author 		AJDE
 * @category 	Admin
 * @package 	EventON/Admin/Settings
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** Store settings in this array */
global $eventon_settings;

if ( ! function_exists( 'eventon_settings' ) ) {
	
	
	
	/**
	 * Settings page.
	 *
	 * Handles the display of the main EventON settings page in admin.
	 *
	 * @access public
	 * @return void
	 */
	function eventon_settings() {
		global $eventon;
		
		do_action('eventon_settings_start');
		
		
		// Settings Tabs array
		$evcal_tabs = apply_filters('eventon_settings_tabs',array(
			'evcal_1'=>__('Settings', 'eventon'), 
			'evcal_2'=>__('Language', 'eventon'),
			'evcal_3'=>__('Styles', 'eventon'),
			'evcal_4'=>__('Addons & Licenses', 'eventon'),
			'evcal_5'=>__('Support', 'eventon'),
		));
		
		
		// Get current tab/section
		$focus_tab = (isset($_GET['tab']) )? sanitize_text_field( urldecode($_GET['tab'])):'evcal_1';	
		$current_section = (isset($_GET['section']) )? sanitize_text_field( urldecode($_GET['section'])):'';	

		$evcal_skins[]=  'slick';
		
		// Update or add options
		if( isset($_POST['evcal_noncename']) && isset( $_POST ) ){
			if ( wp_verify_nonce( $_POST['evcal_noncename'], AJDE_EVCAL_BASENAME ) ){
				
				foreach($_POST as $pf=>$pv){
					if( ($pf!='evcal_styles' && $focus_tab!='evcal_4') || $pf!='evcal_sort_options'){
						
						$pv = (is_array($pv))? $pv: ($pv) ;
						$evcal_options[$pf] = $pv;
					}
					if($pf=='evcal_sort_options'){
						$evcal_options[$pf] =$pv;
					}					
				}


				// General settings page - write styles to head option
				if($focus_tab=='evcal_1' && isset($_POST['evcal_css_head']) && $_POST['evcal_css_head']=='yes'){

					ob_start();
					include(AJDE_EVCAL_PATH.'/assets/css/dynamic_styles.php');

					$evo_dyn_css = ob_get_clean();
					
					update_option('evo_dyn_css', $evo_dyn_css);
				}
				
				
				//language tab
				if($focus_tab=='evcal_2'){
					$new_lang_opt ='';
					$_lang_version = (!empty($_GET['lang']))? $_GET['lang']: 'L1';

					$lang_opt = get_option('evcal_options_evcal_2');
					if(!empty($lang_opt) ){
						$new_lang_opt[$_lang_version] = $evcal_options;
						$new_lang_opt = array_merge($lang_opt, $new_lang_opt);

					}else{
						$new_lang_opt[$_lang_version] =$evcal_options;
					}
					
					update_option('evcal_options_evcal_2', $new_lang_opt);
					
				}elseif($focus_tab == 'evcal_1' || empty($focus_tab)){
					// store custom meta box count
					$cmd_count = evo_calculate_cmd_count();
					$evcal_options['cmd_count'] = $cmd_count;

					update_option('evcal_options_'.$focus_tab, $evcal_options);

				// all other settings tabs
				}else{	
					update_option('evcal_options_'.$focus_tab, $evcal_options);
				}
				
				// STYLES
				if( isset($_POST['evcal_styles']) )
					update_option('evcal_styles', strip_tags(stripslashes($_POST['evcal_styles'])) );
				
				$_POST['settings-updated']='true';			
			

				eventon_generate_options_css();

			// nonce check
			}else{
				die( __( 'Action failed. Please refresh the page and retry.', 'eventon' ) );
			}	
		}
		
		// Load eventon settings values for current tab
		$current_tab_number = substr($focus_tab, -1);		
		if(!is_numeric($current_tab_number)){ // if the tab last character is not numeric then get the whole tab name as the variable name for the options 
			$current_tab_number = $focus_tab;
		}
		
		$evcal_opt[$current_tab_number] = get_option('evcal_options_'.$focus_tab);			

		//print_r(get_option('_evo_licenses'));
		//print_r($evcal_opt[1]);


		// activation notification
		if(!$eventon->evo_updater->is_activated('eventon')){
			echo '<div class="update-nag">'.__('Your copy of EventOn is not activated yet some features may be restricted. <a href="'.get_admin_url().'admin.php?page=eventon&tab=evcal_4">Activate License Now</a>','eventon').'</div>';
		}

// TABBBED HEADER		
?>
<div class="wrap" id='evcal_settings'>
	<div id='eventon'><div id="icon-themes" class="icon32"></div></div>
	<h2>EventON Settings (ver <?php echo get_option('eventon_plugin_version');?>) <?php do_action('eventon_updates_in_settings');?></h2>
	<h2 class='nav-tab-wrapper' id='meta_tabs'>
		<?php					
			foreach($evcal_tabs as $nt=>$ntv){
				$evo_notification='';
				
				echo "<a href='?page=eventon&tab=".$nt."' class='nav-tab ".( ($focus_tab == $nt)? 'nav-tab-active':null)." {$nt}' evcal_meta='evcal_{$nt}'>".$ntv.$evo_notification."</a>";
			}			
		?>
		
	</h2>	
<div class='evo_settings_box'>	
<?php

// SETTINGS SAVED MESSAGE
	$updated_code = (isset($_POST['settings-updated']) && $_POST['settings-updated']=='true')? '<div class="updated fade"><p>'.__('Settings Saved','eventon').'</p></div>':null;
	echo $updated_code;
	
	
// TABS
switch ($focus_tab):
	
	case "evcal_1":
		
		// Event type custom taxonomy NAMES
		$event_type_names = evo_get_ettNames($evcal_opt[1]);
		$evt_name = $event_type_names[1];
		$evt_name2 = $event_type_names[2];

	?>
	<form method="post" action=""><?php settings_fields('evcal_field_group'); 
		wp_nonce_field( AJDE_EVCAL_BASENAME, 'evcal_noncename' );
	?>
	<div id="evcal_1" class=" evcal_admin_meta evcal_focus">		
		
		<div class="evo_inside">
			<?php
				
				require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/class-settings-settings.php');
				$settings = new evo_settings_settings($evcal_opt);
				
				$eventon->load_ajde_backender();
				print_ajde_customization_form($settings->content(), $evcal_opt[1]);
				
			?>
		</div>	
	</div>
	<div class='evo_diag'>
		<input type="submit" class="evo_admin_btn btn_prime" value="<?php _e('Save Changes') ?>" /> <a id='resetColor' style='display:none' class='evo_admin_btn btn_secondary'><?php _e('Reset to default colors','eventon')?></a><br/><br/>
		<a target='_blank' href='http://www.myeventon.com/support/'><img src='<?php echo AJDE_EVCAL_URL;?>/assets/images/myeventon_resources.png'/></a>
	</div>
	
	</form>
	
	
<?php  
	break;
	
	
	// LANGUAGE TAB
	case "evcal_2":


		//print_r($evcal_opt[1]);

		$__lang_version = (!empty($_GET['lang']))? $_GET['lang']: 'L1';
		
		$lang_options = (!empty($evcal_opt[2][$__lang_version]))? $evcal_opt[2][$__lang_version]:null;
		//$lang_options =eventon_process_lang_options($lang_options);
		
		$eventon_months = array(1=>'january','february','march','april','may','june','july','august','september','october','november','december');
		
		$eventon_days = array(1=>'monday','tuesday','wednesday','thursday','friday','saturday','sunday');
		
		
		// Language variations
		$lang_variations = apply_filters('eventon_lang_variation', array('L1','L2', 'L3'));
		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		
?>
<form method="post" action=""><?php settings_fields('evcal_field_group'); 
	wp_nonce_field( AJDE_EVCAL_BASENAME, 'evcal_noncename' );
?>
<div id="evcal_2" class="postbox evcal_admin_meta">	
	<div class="inside">
		<h2><?php _e('Type in custom language text for front-end calendar','eventon');?></h2>
		<h4><?php _e('Select your language','eventon');?> <select id='evo_lang_selection' url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];;?>>		
		<?php
			foreach($lang_variations as $lang){
				echo "<option value='{$lang}' ".(($__lang_version==$lang)? 'selected="select"':null).">{$lang}</option>";
			}
		?></select><span class='evoGuideCall'>?<em><?php _e("You can use this to save upto 2 different languages for customized text. Once saved use the shortcode to show calendar text in that customized language. eg. [add_eventon lang='L2']",'eventon');?></em></span></h4>
		<p><i><?php _e('Please use the below fields to type in custom language text that will be used to replace the default language text on the front-end of the calendar.','eventon')?></i></p>
		
		<div class='evoLANG_section_header evo_settings_toghead'><?php _e('Months and Dates','eventon');?></div>
		<div class='evo_settings_togbox'>
			<div class='evcal_lang_box '>
				
				<?php
					
					// full month names
					for($x=1; $x<13; $x++){
						
						$pre_var_name = 'evcal_lang_';
						
						echo "<p class='evcal_lang_p'><input type='text' name='".$pre_var_name.$x."' class='evcal_lang' value='";
						echo (!empty($lang_options[$pre_var_name.$x]))?  $lang_options[$pre_var_name.$x]: $eventon_months[$x]; echo "'/></p>";
					}
					
					echo "<p class='clear' style='padding-top:5px'></p>";
					
					
					// 3 letter month names
					for($x=1; $x<13; $x++){
						
						$pre_var_name = 'evo_lang_3Lm_';
						$month_3l = substr($eventon_months[$x],0,3);
						
						echo "<p class='evcal_lang_p'><input type='text' name='".$pre_var_name.$x."' class='evcal_lang' value='";
						echo (!empty($lang_options[$pre_var_name.$x]))?  $lang_options[$pre_var_name.$x]: $month_3l; echo "'/></p>";
					}

					echo "<p class='clear' style='padding-top:5px'></p>";

					// 1 letter month names
					for($x=1; $x<13; $x++){
						
						$pre_var_name = 'evo_lang_1Lm_';
						$month_3l = substr($eventon_months[$x],0,1);
						
						echo "<p class='evcal_lang_p'><input type='text' name='".$pre_var_name.$x."' class='evcal_lang' value='";
						echo (!empty($lang_options[$pre_var_name.$x]))?  $lang_options[$pre_var_name.$x]: $month_3l; echo "'/></p>";
					}
					echo "<p class='clear' style='padding-top:5px'></p>";
					
				?><p style='clear:both'></p>			
			</div>
		
			<div class='evcal_lang_box'>
				<?php
					
					
					// full day names
					for($x=1; $x<8; $x++){
						
						$num = $x;
						
						$pre_var_name = 'evcal_lang_day';
						
						echo "<p class='evcal_lang_p'><input type='text' name='".$pre_var_name.$num."' class='evcal_lang' value='";
						echo (!empty($lang_options[$pre_var_name.$num]))?  
							$lang_options[$pre_var_name.$num]: 
							$eventon_days[$x]; 
						echo "'/></p>";	
						
					}
					
					echo "<p class='clear' style='padding-top:5px'></p>";
					// 3 letter day names
					for($x=1; $x<8; $x++){
						
						$num = $x;
						
						$pre_var_name = 'evo_lang_3Ld_';
						$day_3l = substr($eventon_days[$x],0,3);
						
						echo "<p class='evcal_lang_p'><input type='text' name='".$pre_var_name.$num."' class='evcal_lang' value='";
						echo (!empty($lang_options[$pre_var_name.$num]))?  
							$lang_options[$pre_var_name.$num]: 
							$day_3l; 
						echo "'/></p>";							
					}
					
					
					
					if(has_action('eventon_lang_after_daynames'))
						do_action('eventon_lang_after_daynames');
				?>				
				
				<p style='clear:both'></p>
			</div>
			
		</div>
		
		
		<?php
			
			require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/settings_language_tab.php');
			
			// hook into addons
			//eventon_settings_lang_tab_content
			$eventon_custom_language_array_updated = apply_filters('eventon_settings_lang_tab_content', array_filter($eventon_custom_language_array));			
		
			foreach($eventon_custom_language_array_updated as $cl){

				if(!empty($cl['type']) && $cl['type']=='togheader'){
					echo "<div class='evoLANG_section_header evo_settings_toghead'>{$cl['name']}</div>
						<div class='evo_settings_togbox'>";
				}else if(!empty($cl['type']) && $cl['type']=='togend'){
					echo '</div>';
				}else if(!empty($cl['type']) && $cl['type']=='subheader'){
					echo '<div class="evoLANG_subheader">'.$cl['label'].'</div><div class="evoLANG_subsec">';
				}else{

					$val = (!empty($lang_options[$cl['name']]))?  $lang_options[$cl['name']]: '';

					$placeholder = (!empty($cl['placeholder']))?  $cl['placeholder']: '';

					echo "
						<div class='eventon_custom_lang_line'>
							<div class='eventon_cl_label_out'>
								<p class='eventon_cl_label'>{$cl['label']}</p>
							</div>";
					echo '<input class="eventon_cl_input" type="text" name="'.$cl['name'].'" placeholder="'.$placeholder.'" value="'.stripslashes($val).'"/>';
					echo "<div class='clear'></div>
						</div>";
					echo (!empty($cl['legend']))? "<p class='eventon_cl_legend'>{$cl['legend']}</p>":null;	
				}			
			}
		?>		
		
		
		
		
				
	</div>
	
</div>
<input type="submit" class="evo_admin_btn btn_prime" value="<?php _e('Save Changes','eventon') ?>" style='margin-top:15px'/>	
</form>
<?php	
	break;
	
	// STYLES TAB
	case "evcal_3":
		
		echo '<form method="post" action="">';
		
		//settings_fields('evcal_field_group'); 
		wp_nonce_field( AJDE_EVCAL_BASENAME, 'evcal_noncename' );
				
		// styles settings tab content
		require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/settings_styles_tab.php');
	
	break;
	
	// ADDON TAB
	case "evcal_4":
		
		// Addons settings tab content
		require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/settings_addons_tab.php');

	
	break;
	
	// support TAB
	case "evcal_5":
		
		// Addons settings tab content
		require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/settings_support_tab.php');

	
	break;
	
	
		
	// ADVANDED extra field
	case "extra":
	
	// advanced tab content
	require_once(AJDE_EVCAL_PATH.'/includes/admin/settings/settings_advanced_tab.php');		
	
	break;
	
		default:
			do_action('eventon_settings_tabs_'.$focus_tab);
		break;
		endswitch;
		
		echo "</div>";
	}
} // * function exists 

?>