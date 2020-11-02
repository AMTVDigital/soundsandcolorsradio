<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__nosidebar proradio-paper">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-qtvideo' ); 
		?>
		


		<div class="proradio-maincontent">
				<div id="proradio-content">
					<div class="proradio-entrycontent">
				        <div class="proradio-section proradio-paper">
						<?php 
						/**
						 * ======================================================
						 * Content description
						 * ======================================================
						 */
						the_content(); 
						?>
					</div>
				</div>
			</div>
			<?php 
			/**
			 * Related
			 */
			if( get_theme_mod( 'related_video' )){
				get_template_part( 'template-parts/single/part-related-qtvideo' ); 
			}
			?>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();