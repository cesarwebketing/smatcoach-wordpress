<?php	
/*
 *	The template for displaying event categoroes - event organizer 
 *
 *	Override this template by coping it to ../yourtheme/eventon/ folder
 
 *	@Author: AJDE
 *	@EventON
 *	@version: 0.1
 */	
	
	global $eventon;

	get_header();

	$tax = get_query_var( 'taxonomy' );
	$term = get_query_var( 'term' );

	$term = get_term_by( 'slug', $term, $tax );

	do_action('eventon_before_main_content');

	$term_meta = get_option( "taxonomy_".$term->term_id );

	// organizer image
		$img_url = false;
		if(!empty($term_meta['evo_org_img'])){
			$img_url = wp_get_attachment_image_src($term_meta['evo_org_img'],'full');
			$img_url = $img_url[0];
		}

	
?>

<div id="content" class='evo_location_card'>
	<div class="hentry">
		<div class='eventon entry-content'>
			<div class="evo_location_tax" style='background-image:url(<?php echo $img_url;?>)'>
				<?php if($img_url):?><div class="location_circle" style='background-image:url(<?php echo $img_url;?>)'></div><?php endif;?>
				<h2 class="location_name"><span><?php echo $term->name;?></span></h2>
				<div class='location_description'><?php echo category_description();?><p class='contactinfo'><?php echo $term_meta['evcal_org_contact'];?></p></div>
				
			</div>			
			<h3 class="location_subtitle">Events by this organizer</h3>
		
		<?php 
			echo do_shortcode('[add_eventon_list number_of_months="5" '.$tax.'='.$term->term_id.' hide_mult_occur="yes" hide_empty_months="yes"]');
		?>
		</div>
	</div>
</div>

<?php	do_action('eventon_after_main_content'); ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>