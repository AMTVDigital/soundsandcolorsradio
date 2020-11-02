=== ProRadio ===
Contributors: Pro.Radio
Requires at least: WordPress 5.5
Tested up to: WordPress 5.5.1
Version: 1.4.1
Tags: two-columns, right-sidebar

== Description ==
ProRadio: Professional Radio Station WordPress theme

* Mobile-first, Responsive Layout
* Custom Colors
* Custom Header
* Social Links
* Post Formats
* The GPL v2.0 or later license. 

== Installation ==
1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Click "upload" and select the file proradio.zip within the subfolder "themes" of the product package, upload it
3. Click on the 'Activate' button to use your new theme right away.
4. Go to www.ProRadio.xyz/manuals/proradio/ for a guide on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Copyright ==
Pro.Radio WordPress Theme, Copyright 2020 ProRadio.com

== Changelog ==
https://pro.radio/changelog/

[ ] Optional sidebar for videos

1.4.1 [2020-10-14]
[x] Added related news posts to single show page template
[x] PRORADIO ELEMENTOR PLUGIN  added typography selector for chart titles size https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=124
[x] ADDED Elementor color picker for submenu hover and color


1.4.0 [2020-10-09]
[x] Image size performance improvement in shows, post and schedule slider templates
[x] PRORADIO ELEMENTOR PLUGIN Updated to PR.2.0.6
[x] PRORADIO ELEMENTOR PLUGIN Performance improvement for home pages
[x] PRORADIO ELEMENTOR PLUGIN Load widgets js only in Elementor editor
[x] NEW! CUSTOMIZER ADDED scrolled menu background color picker (ticket 82)
[x] NEW! CUSTOMIZER ADDED scrolled menu text color picker https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=82
[x] AJAX PLUGIN Updated plugin PR.3.4.7
[x] AJAX PLUGIN Added preloader colors options
[x] AJAX PLUGIN Added preloader between page change option
[x] AJAX PLUGIN Moved preloader to top layer z-index (above menu)
[x] RADIO PLAYER PLUGIN Updated plugin 3.2.6
[x] RADIO PLAYER PLUGIN Better performance
[x] RADIO PLAYER PLUGIN Minified js version added (optional checkbox in settings)
[x] RADIO PLAYER PLUGIN Added admin settings page
[x] Demo contents: updated contents


1.3.5 [2020-10-06]
[x] removed wp_reset_postdata from 3 files because it was apparently breaking the mega footer. no side effects detected. 
- inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-carousel.php
- inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-carousel.php
- inc/proradio-core-setup/custom-types/schedule/functions/extract-schedule-day.php


1.3.4 [2020-10-05]
[x] template-parts/footer/copyright-bar.php added qt-disableembedding
[x] template-parts/header/secondary-header.php added qt-disableembedding [fix support ticket 89]

1.3.3 [2020-09-23]
[x] Removed debug froom qtt-main.js [popupLink]
[x] Fixed double volume glitch while vol button is in the menu bar (updated player plugin)
[x] moved volume code always in header, added placeholder in footer
[x] RO language translation added
[x] Update Reaktions plugin to 4.0.7 
[x] Update plugin QTM Player to 3.2.5
[x] Fixed Icon colors in menu for mobile
[x] Translations updated to include new strings
[x] Translation label "now on air" in schedule


1.3.2 [2020-09-12]
[x] welcome-page.php remove status transient for udpate when added purchase code
[x] welcome-page.php removed theme version from title welcome box

1.3.1 [2020-09-12]
[x] inc/tgm-plugin-activation/conf.php updated plugin slug

1.3.0 [2020-09-09]
[x] Inline help switch added to Welcome page
[x] Theme updater moved to theme-updater.php from welcome-page.php
[x] remote.php deleted control on page || $_GET['page'] == 'proradio-welcome'
[x] inline helper PHP file renamed from index.php to inline-helper.php
[x] ADDED Audomatic theme backup System
[x] ADDED automatic theme backup before theme udpate
[x] CSS update of welcome page
[x] TGMPA Dismiss link removed 'dismiss'  => $this->dismissable 
[x] TGM REMOVED LINE 1111 class-tgmpa-plugin-activation.php // || get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_' . $this->id, true ) 

1.2.8 [2020-09-07]
[x] added qt-disableembedding to the social icons
[x] UPDATED plugin Prodario Core to PR.4.0.4
[x] secondaryheader.scss fixed song title alignment
[x] Performance improvements: removed certain visual effects
[x] Fixed color controls on menu items
[x] Added background color for submenu items
[x] Inline manual in admin
[x] Upcoming post slider + carousel: Huge logic fix for upcoming shows extractions, cross midnight function fixed

1.2.7 [2020-08-18]
[x] Updated Server Check plugin version internal zip
[x] Updated ProRadio theme core plugin online repository

1.2.6 [2020-07-22]
[x] main.js update and added minified version

1.2.5
[x] WooCommerce update
[x] 3D updated
[x] Performance improvement
[x] Added new License Key validation
[x] Added Javascript Debug option in customizer advanced section