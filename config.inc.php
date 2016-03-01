<?php
// init addon
$REX['ADDON']['name']['navigation_factory'] = 'Navigation Factory';
$REX['ADDON']['page']['navigation_factory'] = 'navigation_factory';
$REX['ADDON']['version']['navigation_factory'] = '1.1.1';
$REX['ADDON']['author']['navigation_factory'] = 'RexDude';
$REX['ADDON']['supportpage']['navigation_factory'] = 'forum.redaxo.org';
$REX['ADDON']['perm']['navigation_factory'] = 'navigation_factory[]';

// permissions
$REX['PERM'][] = 'navigation_factory[]';

// add lang file
if ($REX['REDAXO']) {
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/navigation_factory/lang/');
}

// includes
require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.rex_nav.inc.php');
require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.rex_lang_nav.inc.php');
require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.rex_breadcrumb_nav.inc.php');
require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.rex_navigation_factory_utils.inc.php');

if (rex_request('page') != 'addon') {
	if (!class_exists('simple_html_dom_node') && !OOPlugin::isAvailable('rexsearch', 'plaintext')) {
		require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.simple_html_dom.inc.php');
	}
}

if ($REX['REDAXO']) {
	// add subpages
	$REX['ADDON']['navigation_factory']['SUBPAGES'] = array(
		array('', $I18N->msg('navigation_factory_start')),
		array('codeexamples', $I18N->msg('navigation_factory_codeexamples')),
		array('help', $I18N->msg('navigation_factory_help'))
	);

	// add css/js files to page header
	if (rex_request('page') == 'navigation_factory') {
		rex_register_extension('PAGE_HEADER', 'rex_navigation_factory_utils::appendToPageHeader');
	}
}
?>
