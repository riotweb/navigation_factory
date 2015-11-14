<?php

$search = array('(CHANGELOG.md)', '(LICENSE.md)', '(CODEEXAMPLES.md)');
$replace = array('(index.php?page=navigation_factory&subpage=help&chapter=changelog)', '(index.php?page=navigation_factory&subpage=help&chapter=license)', '(index.php?page=navigation_factory&subpage=help&chapter=codeexamples)');

echo rex_navigation_factory_utils::getHtmlFromMDFile('README.md', $search, $replace);

