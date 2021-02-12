<?php
/**
 *
 *	Playlist
 *  @package  WordPress
 *  @subpackage qtmplayer
 *
 * 	This is the pre-loaded playlist you see in the player
 */

?>
<div id="qtmplayer-playlistcontainer" class="qtmplayer__playlistcontainer qtmplayer-content-primary">
	<span class="qtmplayer__plclose" data-playlistopen>
		<i class='material-icons'>chevron_left</i>
	</span>
	<div class="qtmplayer__playlistmaster">
		<div class="qtmplayer-column-left">
			<div id="qtmplayer-cover" class="qtmplayer__album">
				<a href="#" class="qtmplayer-btn qtmplayer-btn-ghost qtmplayer-btn-l qtmplayer-albumlink"><?php esc_html_e( "Go to album", 'qtmplayer' ); ?></a>
			</div>
		</div>
		<div id="qtmplayer-playlist" class="qtmplayer__playlist qtmplayer-content-primary qtmplayer-column-right">
			<ul class="qtmplayer-playlist">
				<?php  

				/**
				 * 
				 * @since  2.0.0 added radiochannels
				 * Radio channels playlist
				 * 
				 */
				
				/**
				 * =================================
				 * IMPORTANT
				 * =================================
				 * NEEDS TO BE FIRST OTHERWISE IF YOU USE THE TITLES WIDGET IT WON'T INITIALIZD
				 */
				include('part-playlist-radio.php'); 

				/**
				 * 
				 * @since  1.0.0 Customizer playlist
				 * Custom files playlist
				 * 
				 */
				include('part-playlist-custom.php');

				/**
				 * 
				 * @since  3.1.6 Podcasts
				 * 
				 */
				include('part-playlist-podcast.php');

				
				

				/**
				 * 
				 * @since  1.0.0 Customizer playlist
				 * Featured audio posts (customizer settings)
				 * 
				 */
				include('part-playlist-featured.php');

				/**
				 *
				 * @since 1.0.0
				 * Default podcast extraction
				 * 
				 */
				include('part-playlist-default.php');

				/**
				 * =================================================
				 * END OF QtMplayer preload podcast
				 * =================================================
				 */
				
				?>
			</ul>
		</div>
	</div>
</div>
