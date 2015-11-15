<?php

$mypage = rex_request('page','string');
$subpage = rex_request('subpage', 'string');
$chapter = rex_request('chapter', 'string');
$func = rex_request('func', 'string');

if ($chapter == '') {
	$chapter = '';
}

// include markdwon parser
if (!class_exists('Parsedown')) {
	require($REX['INCLUDE_PATH'] . '/addons/navigation_factory/classes/class.parsedown.inc.php');
}

// chapters
$chapterpages = array (
	'' => array($I18N->msg('navigation_factory_codeexamples_chapter_rex_nav'), 'pages/codeexamples/rex_nav.inc.php'),
	'rex_lang_nav' => array($I18N->msg('navigation_factory_codeexamples_chapter_rex_lang_nav'), 'pages/codeexamples/rex_lang_nav.inc.php'),
	'rex_breadcrumb_nav' => array($I18N->msg('navigation_factory_codeexamples_chapter_rex_breadcrumb_nav'), 'pages/codeexamples/rex_breadcrumb_nav.inc.php')
);

// build chapter navigation
$chapternav = '';

foreach ($chapterpages as $chapterparam => $chapterprops) {
	if ($chapterprops[0] != '') {
		if ($chapter != $chapterparam) {
			$chapternav .= ' | <a href="?page=' . $mypage . '&amp;subpage=' . $subpage . '&amp;chapter=' . $chapterparam . '">' . $chapterprops[0] . '</a>';
		} else {
			$chapternav .= ' | <a class="rex-active" href="?page=' . $mypage . '&amp;subpage=' . $subpage . '&amp;chapter=' . $chapterparam . '">' . $chapterprops[0] . '</a>';
		}
	}
}
$chapternav = ltrim($chapternav, " | ");

// build chapter output
$addonroot = $REX['INCLUDE_PATH']. '/addons/'.$mypage.'/';
$source    = $chapterpages[$chapter][1];

// output
echo '
<div class="rex-addon-output" id="subpage-' . $subpage . '">
  <h2 class="rex-hl2" style="font-size:1em">' . $chapternav . '</h2>
  <div class="rex-addon-content">
    <div class= "addon-template">
    ';

include($addonroot . $source);

echo '
    </div>
  </div>
</div>';

?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// make external links clickable
	$("#subpage-help").delegate("a", "click", function(event) {
		var host = new RegExp("/" + window.location.host + "/");

		if (!host.test(this.href)) {
			event.preventDefault();
			event.stopPropagation();

			window.open(this.href, "_blank");
		}
	});
});
</script>
