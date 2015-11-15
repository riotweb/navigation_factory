<?php

class rex_lang_nav {
	protected $listId;
	protected $listClass;
	protected $selectedClass;
	protected $showListItemIds;
	protected $hideListItemIfOfflineArticle;
	protected $useLangCodeAsLinkText;
	protected $upperCaseLinkText;

	public function __construct() {
		$this->listId = '';
		$this->listClass = '';
		$this->selectedClass = 'selected';
		$this->showListItemIds = false;
		$this->hideListItemIfOfflineArticle = false;
		$this->useLangCodeAsLinkText = false;
		$this->upperCaseLinkText = false;
	}

	public function setListId($listId) {
		$this->listId = $listId;
	}
	
	public function setListClass($listClass) {
		$this->listClass = $listClass;
	}

	public function setSelectedClass($selectedClass) {
		$this->selectedClass = $selectedClass;
	}

	public function setShowListItemIds($showListItemIds) {
		$this->showListItemIds = $showListItemIds;
	}

	public function setHideListItemIfOfflineArticle($hideListItemIfOfflineArticle) {
		$this->hideListItemIfOfflineArticle = $hideListItemIfOfflineArticle;
	}

	public function setUseLangCodeAsLinkText($useLangCodeAsLinkText) {
		$this->useLangCodeAsLinkText = $useLangCodeAsLinkText;
	}

	public function setUpperCaseLinkText($upperCaseLinkText) {
		$this->upperCaseLinkText = $upperCaseLinkText;
	}

	public function getNavigation() {
		global $REX;

		// list id
		if ($this->listId == '') {
			$listIdAttribute = '';
		} else {
			$listIdAttribute = ' id="' . $this->listId . '"';
		}
		
		// list class
		if ($this->listClass == '') {
			$listClassAttribute = '';
		} else {
			$listClassAttribute = ' class="' . $this->listClass . '"';
		}

		$out = '<ul' . $listIdAttribute . $listClassAttribute . '>';

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

			if (!$articleStatus && $this->hideListItemIfOfflineArticle) {
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
				if ($this->showListItemIds) {
					$listItemIdAttribute = ' id="' . $langSlug . '"';
				} else {
					$listItemIdAttribute = '';
				}

				// class attribute
				if ($REX['CUR_CLANG'] == $clangId) {
					$listItemClassAttribute = ' class="' . $this->selectedClass . '"';
				} else {
					$listItemClassAttribute = '';
				}
				
				// li out
				$out .= '<li' . $listItemIdAttribute . $listItemClassAttribute . '><a href="' . rex_getUrl($newArticleId, $clangId) . '">' . $linkText . '</a></li>';
			}
		}

		$out .= '</ul>';

		return $out;
	}
}

