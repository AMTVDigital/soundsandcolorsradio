/**
 * INSTRUCTIONS
 * ────────────────────────────────────────────────────────────
 * After the activation a new item will appear on the admin menu.
 * 1. In Page Builder > Role Manager - enable Page Builder for  proradio_megafooter_page
 * 2. in PHP in the theme, add the megafooter tag:
 * ────────────────────────────────────────────────────────────
	
	if( function_exists('proradio_megafooter_display')) {
		proradio_megafooter_display();
	}
	
 * ────────────────────────────────────────────────────────────
 * 3. Choose the footer you want to display on every page by using the select in the footer item
 * 4. In order to hide the footer on custom pages or use a special one, edit the custom fields in the single page 
 * 
 */


CHANGELOG
PR.1.1.0 [2021 Jan 13]
* Update for Elementor 3.0.16 causing issue of duplicated content in Elementor pages

PR.1.0.9 [2020 Dec 22]
* added z-index 2 to megafooter_container

1.0.6 [2019 may 22]
* Custom CSS stylesheet no longer enqueued, is in the theme css
* added custom css to the header