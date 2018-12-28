<?php 
//
//
// Theme configuration options
//
//

// Don't change the following constant. A lot of things depend on this.
// Even if you duplicate this file in a child theme, DON'T change this constant.
if(!defined('TRUENORTH_NAME')) 		define('TRUENORTH_NAME', 'truenorth');

// The following constant stores the name as it should be printed, i.e. the nice name. 
// Spaces, special characters, etc. are allowed.
// You should probably change that if you are white-labeling the theme.
if(!defined('TRUENORTH_NICENAME')) 	define('TRUENORTH_NICENAME', 'True North');

// Set the URL of the online documentation here. Appears on top of the CSSIgniter Settings panel as "Documentation".
// You can set it to an empty string if you want to remove the "Documentation" link.
if(!defined('CI_DOCS'))				define('CI_DOCS', 'http://cssigniter.com/docs/'.TRUENORTH_NAME);

// Set the URL of the online support forum. Appears on top of the CSSIgniter Settings panel as "Support forum".
// You can set it to an empty string if you want to remove the "Support forum" link.
if(!defined('CI_FORUM'))			define('CI_FORUM', 'https://cssigniter.ticksy.com/');

// Set the following to true, if you want to remove any CSSIgniter traces.
// You should probably review and change the TRUENORTH_NICENAME, CI_DOCS, and CI_FORUM constants above. 
if(!defined('CI_WHITELABEL')) 		define('CI_WHITELABEL', false);

// Set the following to false if you don't want the theme to automatically check for updates.
// Update checks occur once per day, and if an update is available, a message appears on top of the CSSIgniter Settings panel.
if(!defined('TRUENORTH_UPDATES')) 	define('TRUENORTH_UPDATES', true);

