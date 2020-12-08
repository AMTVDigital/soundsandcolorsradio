<?php
/**
 *
 *	Control bar
 *  @package  WordPress
 *  @subpackage qtmplayer
 */

?>
<div id="qtmplayer-controls"  class="qtmplayer__controls" data-hidetimeout="1000">
	<div class="qtmplayer__controllayer">
		<div class="qtmplayer__basic">
			<a id="qtmplayerPlay" data-qtmplayer-playbtn class="qtmplayer__play qtmplayer-btn-secondary">
				<i class="material-icons">play_arrow</i>
				<i id="qtmplayerNotif" data-qtmplayerNotif class="qtmplayer__notification"></i>
			</a>
			<div class="qtmplayer__songdata">
				<p class="qtmplayer__title proradio-marquee"></p>
				<p class="qtmplayer__artist proradio-marquee"></p>
			</div>
			<span data-playeropen class="qtmplayer__openbtn"><i class="material-icons">keyboard_arrow_right</i></span>
		</div>
		<div class="qtmplayer__advanced">
			<div class="qtmplayer__covercontainer">
				<a class="qtmplayer__cover"></a>
			</div>
			<div class="qtmplayer__songdatam">
				<p class="qtmplayer__title"></p>
				<p class="qtmplayer__artist"></p>
			</div>
			<div class="qtmplayer__actions">
				<?php  

				if(isset($_GET)){
					if(isset($_GET['proradio-popup'])){
						?>
						
							<?php qtmplayer_volume_control(); ?>
					
						<?php
						
					}
				}
				?>
				<span class="qtmplayer__prev" data-control="prev">
					<i class='material-icons'>skip_previous</i>
				</span>
				<a data-qtmplayer-playbtn class="qtmplayer__playmob">
					<i class="material-icons">play_arrow</i>
					<i id="qtmplayerNotifM" data-qtmplayerNotif class="qtmplayer__notification qtmplayer-content-secondary"></i>
				</a>
				<span class="qtmplayer__next" data-control="next">
					<i class='material-icons'>skip_next</i>
				</span>
				<a id="qtmplayerCart" href="#" target="_blank" class="qtmplayer__cart <?php if('none' === get_theme_mod( 'qtmplayer_icon_cart', 'inline-block' ) ){ echo 'qtmplayer-hidebtn' ; } ?>">
					<i class='material-icons'></i>
				</a>
			</div>
			<div class="qtmplayer__trackcontainer">
				<div id="qtmplayerTrackControl" data-qtmplayer-trackcontrol class="qtmplayer__track">
					<span id="qtmplayerTime" class="qtmplayer__time">00:00</span>
					<span id="qtmplayerDuration" class="qtmplayer__length">00:00</span>
					<span id="qtmplayerTrackAdv" class="qtmplayer-track-adv qtmplayer-tbg"></span>
					<span id="qtMplayerBuffer" class="qtmplayer-track-adv qtmplayer-buffer"></span>
					<span id="qtMplayerTadv" data-qtmplayer-trackadv class="qtmplayer-track-adv qtmplayer-content-accent"></span>
					<span id="qtMplayerMiniCue" data-qtmplayer-minicue class="qtmplayer-track-minicue"></span>
				</div>
			</div>
			<?php if(get_theme_mod( 'qtmplayer_icon_playlist', 'inline-block' ) !== 'none'){ ?>
			<span class="qtmplayer__playlistbtn" data-playlistopen>
				<i class='material-icons'>playlist_play</i>
			</span>
			<?php } ?>
			<?php  ?>
			<span class="qtmplayer__plclose qtmplayer__plclose__adv" data-playeropen>
				<i class='material-icons'>chevron_left</i>
			</span>
			<?php  
			/**
			 * Volume Controller Template
			 * Used also in other functions
			 * 
			 */
			if( !get_theme_mod( 'proradio_vol_header' ) ){
				qtmplayer_volume_control();
			}
			
			?>
			<div class="qtmplayer__bgimg"></div>
		</div>
	</div>
</div>
