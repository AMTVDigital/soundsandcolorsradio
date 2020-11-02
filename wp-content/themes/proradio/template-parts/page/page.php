<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */


if ( have_posts() ) : while ( have_posts() ) : the_post();
	/**
	 * ======================================================
	 * Page header template
	 * ======================================================
	 */
	set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
	get_template_part( 'template-parts/pageheader/pageheader-page' ); 
	?>
	<div class="proradio-maincontent">
		<div class="proradio-section proradio-paper">
			<div class="proradio-container">
				<div class="proradio-entrycontent">
					<div class="proradio-the_content">
						<?php the_content(); ?>
					</div>
					<?php 
					$atts_pagelink = array(
						'before'           => '<h6 class="proradio-itemmetas proradio-pagelinks">',
						'after'            => '</h6>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'next',
						'separator'        => '  ',
						'nextpagelink'     => esc_html__( 'Next page', 'proradio').'<i class="material-icons">chevron_right</i>',
						'previouspagelink' => '<i class="material-icons">chevron_left</i>'.esc_html__( 'Previous page', 'proradio' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $atts_pagelink ); 
					?>
				</div>
			</div>
		</div>
	</div>

	<?php  
	/**
	 * ==============================================
	 * Comments section here
	 * ==============================================
	 */
	$comments_count = wp_count_comments( $id );
	$comments_count = $comments_count->approved;
	if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<div class="proradio-section proradio-bg">
			<div class="proradio-container">
				<div class="proradio-comments-section">
					<h3 class="proradio-caption proradio-caption__l"><span><?php esc_html_e("Post comments","proradio"); ?> (<?php echo esc_html( $comments_count ); ?>)</span></h3>
					<?php  
					/**
					 * Comments template
					 */
					comments_template();
					?>
				</div>
			</div>
		</div>
		<?php 
	endif; 
	

	
endwhile; endif;

