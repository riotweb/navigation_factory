<?php

class rex_nav {
	protected $startCategoryId;
	protected $levelDepth;
	protected $showAll;
	protected $ignoreOfflines;
	protected $hideWebsiteStartArticle;
	protected $selectedClass;
	protected $activeClass;
	protected $listId;
	protected $listClass;
	protected $listItemClass;
	protected $listItemIdFromMetaField;
	protected $listItemClassFromMetaField;
	protected $customLinkFunction;
	protected $hideIds;
	protected $listItemIdFromCategoryId;
	protected $listItemClassFromCategoryId;
	protected $showHasSubClass;
	protected $hasSubClass;

	// old vars from rex_navigation
	var $path = array();
	var $callbacks = array();
	var $current_article_id = -1;
	var $current_category_id = -1;

	public function __construct() {
		$this->startCategoryId = 0;
		$this->levelDepth = 3;
		$this->showAll = false;
		$this->ignoreOfflines = true;
		$this->hideWebsiteStartArticle = false;
		$this->selectedClass = 'selected';
		$this->activeClass = 'selected active';
		$this->listId = array();
		$this->listClass = array();
		$this->listItemClass = '';
		$this->listItemIdFromMetaField = '';
		$this->listItemClassFromMetaField = '';
		$this->customLinkFunction = '';
		$this->hideIds = array();
		$this->listItemIdFromCategoryId = array();
		$this->listItemClassFromCategoryId = array();
		$this->showHasSubClass = false;
		$this->hasSubClass = 'has-sub';
	}

	public function getNavigation() {
		return $this->get($this->startCategoryId);
	}

	public function setStartCategoryId($catId) {
		$this->startCategoryId = $catId;
	}

	public function setStartLevel($startLevel) {
		global $REX;

		$navPath = explode('|', ('0|0' . $REX['ART'][$REX['ARTICLE_ID']]['path'][$REX['CUR_CLANG']] . $REX['ARTICLE_ID'] . '|'));

		if (isset($navPath[$startLevel]) && $navPath[$startLevel] != '') {
			$this->startCategoryId = $navPath[$startLevel];
		} else {
			$this->startCategoryId = -1;
		}
	}

	public function setLevelDepth($levelDepth) {
		$this->levelDepth = $levelDepth;
	}

	public function setShowAll($showAll) {
		$this->showAll = $showAll;
	}

	public function setIgnoreOfflines($ignoreOfflines) {
		$this->ignoreOfflines = $ignoreOfflines;
	}

	public function setHideWebsiteStartArticle($hideWebsiteStartArticle) {
		$this->hideWebsiteStartArticle = $hideWebsiteStartArticle;
	}

	public function setSelectedClass($selectedClass) {
		$this->selectedClass = $selectedClass;
	}

	public function setActiveClass($activeClass) {
		$this->activeClass = $activeClass;
	}

	public function setListId($listId, $level = 1) {
		$this->listId[$level - 1] = $listId;
	}

	public function setListClass($listClass, $level = 1) {
		$this->listClass[$level - 1] = $listClass;
	}

	public function setListItemClass($listItemClass) {
		$this->listItemClass = $listItemClass;
	}

	public function setListItemIdFromMetaField($listItemIdFromMetaField) {
		$this->listItemIdFromMetaField = $listItemIdFromMetaField;
	}

	public function setListItemClassFromMetaField($listItemClassFromMetaField) {
		$this->listItemClassFromMetaField = $listItemClassFromMetaField;
	}

	public function setCustomLink($customLinkFunction) {
		$this->customLinkFunction = $customLinkFunction;
	}

	public function setHideIds($hideIds) {
		$this->hideIds = $hideIds;
	}

	public function setListItemIdFromCategoryId($listItemIdFromCategoryId) {
		$this->listItemIdFromCategoryId = $listItemIdFromCategoryId;
	}

	public function setListItemClassFromCategoryId($listItemClassFromCategoryId) {
		$this->listItemClassFromCategoryId = $listItemClassFromCategoryId;
	}

	public function setShowHasSubClass($showHasSubClass) {
		$this->showHasSubClass = $showHasSubClass;
	}

	public function setHasSubClass($hasSubClass) {
		$this->hasSubClass = $hasSubClass;
	}

	protected function _getNavigation($categoryId) { 
		global $REX;

		static $depth = 0;

		$return = '';
		$listIdAttribute = '';
		$listClassAttribute = '';
		$listClasses = '';
		
		if ($categoryId < 0) {
			return '';
		} elseif ($categoryId < 1) {
			$cats = OOCategory::getRootCategories($this->ignoreOfflines);
		} else {
			$cats = OOCategory::getChildrenById($categoryId, $this->ignoreOfflines);

			if ($this->showHasSubClass) {
				$listClasses .= ' ' . $this->hasSubClass;
			}
		}

		if (count($cats) > 0) {
			if (isset($this->listId[$depth])) {
				$listIdAttribute = ' id="' . $this->listId[$depth] . '"';
			}

			if (isset($this->listClass[$depth])) {
				$listClasses .= ' ' . $this->listClass[$depth];
			}

			if ($listClasses != '') {
				$listClassAttribute = ' class="' . trim($listClasses) . '"';
			}

			$return .= '<ul' . $listIdAttribute . $listClassAttribute . '>';
		}
			
		foreach ($cats as $cat) {
			if ($this->_checkCallbacks($cat, $depth)) {
				$cssClasses = '';
				$idAttribute = '';

				// default li class
				if ($this->listItemClass != '') {
					$cssClasses .= ' ' . $this->listItemClass;
				}

				// li class
				if (is_array($this->listItemClassFromCategoryId) && isset($this->listItemClassFromCategoryId[$cat->getId()])) {
					$cssClasses .= ' ' . $this->listItemClassFromCategoryId[$cat->getId()];
				}

				if ($this->listItemClassFromMetaField != '' && $cat->getValue($this->listItemClassFromMetaField) != '') {
					$cssClasses .= ' ' . $cat->getValue($this->listItemClassFromMetaField);
				}

				// li id
				if (is_array($this->listItemIdFromCategoryId) && isset($this->listItemIdFromCategoryId[$cat->getId()])) {
					$idAttribute = ' id="' . $this->listItemIdFromCategoryId[$cat->getId()] . '"';
				} elseif ($this->listItemIdFromMetaField != '' && $cat->getValue($this->listItemIdFromMetaField) != '') {
					$idAttribute = ' id="' . $cat->getValue($this->listItemIdFromMetaField) . '"';
				}

				// selected class
				if ($cat->getId() == $this->current_category_id) {
					// active menuitem
					$cssClasses .= ' ' . $this->activeClass;
				} elseif (in_array($cat->getId(), $this->path)) {
					// current menuitem
					$cssClasses .= ' ' . $this->selectedClass;
				} else {
					// do nothing
				}

				$trimmedCssClasses = trim($cssClasses);

				// build class attribute
				if ($trimmedCssClasses != '') {
					$classAttribute = ' class="' . $trimmedCssClasses . '"';
				} else {
					$classAttribute = '';
				}

				if (($this->hideWebsiteStartArticle && ($cat->getId() == $REX['START_ARTICLE_ID'])) || (in_array($cat->getId(), $this->hideIds))) {
					// do nothing
				} else {
					$depth++;
					$urlType = 0; // default

					$return .= '<li' . $idAttribute . $classAttribute . '>';

					if ($this->customLinkFunction != '') {
						$defaultLink = call_user_func($this->customLinkFunction, $cat, $depth);
					} else {
						$defaultLink = '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
					}

					if (!class_exists('seo42')) {
						// normal behaviour
						$return .= $defaultLink;
					} else {
						// only with seo42 2.0.0+
						$urlData = seo42::getCustomUrlData($cat);

						// check if default lang has url clone option (but only if current categoy has no url data set)
						if (count($REX['CLANG']) > 1 && !isset($urlData['url_type'])) {
							$defaultLangCat = OOCategory::getCategoryById($cat->getId(), $REX['START_CLANG_ID']);
							$urlDataDefaultLang = seo42::getCustomUrlData($defaultLangCat);
				
							if (isset($urlDataDefaultLang['url_clone']) && $urlDataDefaultLang['url_clone']) {
								// clone url data from default language to current language
								$urlData = $urlDataDefaultLang;
							}
						}

						if (isset($urlData['url_type'])) {
							switch ($urlData['url_type']) { 
								case 5: // SEO42_URL_TYPE_NONE
									$return .= htmlspecialchars($cat->getName());
									break;
								case 4: // SEO42_URL_TYPE_LANGSWITCH
									$newClangId = $urlData['clang_id'];
									$newArticleId = $REX['ARTICLE_ID'];
									$catNewLang = OOCategory::getCategoryById($newArticleId, $newClangId);

									// if category that should be switched is not online, switch to start article of website
									if (OOCategory::isValid($catNewLang) && !$catNewLang->isOnline()) {
										$newArticleId = $REX['START_ARTICLE_ID'];
									}

									// select li that is current language
									if ($REX['CUR_CLANG'] == $newClangId) {
										$return = substr($return, 0, strlen($return) - strlen('<li>'));
										$return .= '<li class="' . $this->selectedClass . '">';
									}

									$return .= '<a href="' . rex_getUrl($newArticleId, $newClangId) . '">' . htmlspecialchars($cat->getName()) . '</a>';
									break;
								case 8: // SEO42_URL_TYPE_CALL_FUNC
									$return .= call_user_func($urlData['func'], $cat);
									break;
								default:
									$return .= $defaultLink;
									break;
							}
						} else {
							$return .= $defaultLink;
						}
					} 
				
					if (($this->showAll || $cat->getId() == $this->current_category_id || in_array($cat->getId(), $this->path)) && ($this->levelDepth > $depth || $this->levelDepth < 0)) {
						$return .= $this->_getNavigation($cat->getId());
					}
				
					$depth--;

					$return .= '</li>';
				}
			}
		}

		if (count($cats) > 0) {
			$return .= '</ul>';
		}

		return $return;
	}

	protected function get($categoryId = 0) { 
		if (!$this->_setActivePath()) {
			return false;
		}

		if (class_exists('rex_com_auth')) {
			$this->addCallback("nav42::checkPerm");
		}
		
		return $this->_getNavigation($categoryId);
	}

	protected function _setActivePath() {
		global $REX;

		$article_id = $REX["ARTICLE_ID"];
		
		if ($OOArt = OOArticle::getArticleById($article_id)) {
			$path = trim($OOArt->getValue("path"), '|');
			$this->path = array();

			if	($path != "") {
				$this->path = explode("|", $path);
			}

			$this->current_article_id = $article_id;
			$this->current_category_id = $OOArt->getCategoryId();
	
			return TRUE;
		}

		return FALSE;
	}

	protected function checkPerm($nav, $depth) {
		return rex_com_auth::checkPerm($nav);
	}

	public function addCallback($callback = "", $depth = "") {
		if ($callback != "") {
			$this->callbacks[] = array("callback" => $callback, "depth" => $depth);
		}
	}

	protected function _checkCallbacks($category, $depth) {
		foreach($this->callbacks as $c) {
			if ($c["depth"] == "" || $c["depth"] == $depth) {
				$callback = $c['callback'];
			
				if (is_string($callback)) {
					$callback = explode('::', $callback, 2);

					if (count($callback) < 2) {
						$callback = $callback[0];
					}
				}

				if (is_array($callback) && count($callback) > 1) {
					list($class, $method) = $callback;

					if (is_object($class)) {
						$result = $class->$method($category, $depth);
					} else {
						$result = $class::$method($category, $depth);
					}
				} else {
					$result = $callback($category, $depth);
				}

				if (!$result) {
					return false;
				}
			}
		}

		return true;
	}
}

