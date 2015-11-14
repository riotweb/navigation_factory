<?php

class rex_lang_nav {
	protected $ulId;
	protected $ulClass;
	protected $selectedClass;
	protected $showLiIds;
	protected $hideLiIfOfflineArticle;
	protected $useLangCodeAsLinkText;
	protected $upperCaseLinkText;

	public function __construct() {
		$this->ulId = '';
		$this->ulClass = '';
		$this->selectedClass = 'selected';
		$this->showLiIds = false;
		$this->hideLiIfOfflineArticle = false;
		$this->useLangCodeAsLinkText = false;
		$this->upperCaseLinkText = false;
	}

	public function setUlId($ulId) {
		$this->ulId = $ulId;
	}
	
	public function setUlClass($ulClass) {
		$this->ulClass = $ulClass;
	}

	public function setSelectedClass($selectedClass) {
		$this->selectedClass = $selectedClass;
	}

	public function setShowLiIds($showLiIds) {
		$this->showLiIds = $showLiIds;
	}

	public function setHideLiIfOfflineArticle($hideLiIfOfflineArticle) {
		$this->hideLiIfOfflineArticle = $hideLiIfOfflineArticle;
	}

	public function setUseLangCodeAsLinkText($useLangCodeAsLinkText) {
		$this->useLangCodeAsLinkText = $useLangCodeAsLinkText;
	}

	public function setUpperCaseLinkText($upperCaseLinkText) {
		$this->upperCaseLinkText = $upperCaseLinkText;
	}

	public function getNavigation() {
		global $REX;

		// ul id
		if ($this->ulId == '') {
			$ulIdAttribute = '';
		} else {
			$ulIdAttribute = ' id="' . $this->ulId . '"';
		}
		
		// ul class
		if ($this->ulClass != '') {
			$ulIdAttribute .= ' class="' . $this->ulClass . '"';	
		}

		$out = '<ul' . $ulIdAttribute . '>';

		foreach ($REX['CLANG'] as $clangId => $clangName) {
			$article = OOArticle::getArticleById($REX['ARTICLE_ID'], $clangId);

			// new article id
			if (OOArticle::isValid($article) && $article->isOnline()) {
				$newArticleId = $article->getId();
				$articleStatus = true;
			} else {
				$newArticleId = $REX['START_ARTICLE_ID'];
				$articleStatus = false;
			}

			if (!$articleStatus && $this->hideLiIfOfflineArticle) {
				// do nothing
			} else {
				$langCode = '';
				$originalName = '';
				$langSlug = '';

				if (class_exists('seo42')) {
					$langCode = seo42::getLangCode($clangId);
					$originalName = seo42::getOriginalLangName($clangId);
					$langSlug = seo42::getLangUrlSlug($clangId);
				} 

				if ($langCode == '') {
					$langCode = $clangName;
				}

				if ($originalName == '') {
					$originalName = $clangName;
				}

				if ($langSlug == '') {
					$langSlug = $clangName;
				}

				// link text
				if ($this->useLangCodeAsLinkText) {
					$linkText = $langCode;
				} else {
					$linkText = $originalName;
				}

				if ($this->upperCaseLinkText) {
					$linkText = strtoupper($linkText);
				}

				// li attribute
				if ($this->showLiIds) {
					$liIdAttribute = ' id="' . $langSlug . '"';
				} else {
					$liIdAttribute = '';
				}

				// class attribute
				if ($REX['CUR_CLANG'] == $clangId) {
					$liClassAttribute = ' class="' . $this->selectedClass . '"';
				} else {
					$liClassAttribute = '';
				}
				
				// li out
				$out .= '<li' . $liIdAttribute . $liClassAttribute . '><a href="' . rex_getUrl($newArticleId, $clangId) . '">' . $linkText . '</a></li>';
			}
		}

		$out .= '</ul>';

		return $out;
	}
}

