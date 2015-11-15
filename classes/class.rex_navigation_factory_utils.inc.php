<?php
class rex_navigation_factory_utils {
	public static function appendToPageHeader($params) {
		global $REX;

		$insert = '<!-- BEGIN navigation_factory -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/navigation_factory/backend.css" />' . PHP_EOL;
		$insert .= '<!-- END navigation_factory -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}

	public static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}

	public static function getHtmlFromMDFile($mdFile, $search = array(), $replace = array(), $setBreaksEnabled = true, $useDocsDir = false) {
		global $REX;

		$curLocale = strtolower($REX['LANG']);

		if ($useDocsDir) {
			$rootPath = $REX['INCLUDE_PATH'] . '/addons/navigation_factory/docs/';
		} else {
			$rootPath = $REX['INCLUDE_PATH'] . '/addons/navigation_factory/';
		}

		if ($curLocale == 'de_de') {
			$file = $rootPath . $mdFile;
		} else {
			$file = $rootPath . 'lang/' . $curLocale . '/' . $mdFile;
		}

		if (file_exists($file)) {
			$md = file_get_contents($file);
			$md = str_replace($search, $replace, $md);
			$md = self::makeHeadlinePretty($md);

			$md = str_replace('```php', "```php\r\n<?php", $md);

			if (method_exists('Parsedown', 'set_breaks_enabled')) {
				$out = Parsedown::instance()->set_breaks_enabled($setBreaksEnabled)->parse($md);
			} elseif (method_exists('Parsedown', 'setBreaksEnabled')) {
				$out = Parsedown::instance()->setBreaksEnabled($setBreaksEnabled)->parse($md);
			} else {
				$out = Parsedown::instance()->parse($md);
			}

			$out = str_replace('&lt;?php<br />', "", $out);

			return $out;
		} else {
			return '[translate:' . $file . ']';
		}
	}

	public static function makeHeadlinePretty($md) {
		return str_replace('Navigation Factory - ', '', $md);
	}
}

