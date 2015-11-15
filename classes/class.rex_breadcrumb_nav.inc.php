<?php

class rex_breadcrumb_nav {
	protected $listId;
	protected $listClass;
	protected $orderedList;
	protected $startArticleName;
	protected $startArticleIconClass;
	protected $hideStartArticleName;

	public function __construct() {
		$this->listId = '';
		$this->listClass = '';
		$this->orderedList = false;
		$this->startArticleName = '';
		$this->startArticleIconClass = '';
		$this->hideStartArticleName = false;
	}

	public function setListId($listId) {
		$this->listId = $listId;
	}

	public function setListClass($listClass) {
		$this->listClass = $listClass;
	}

	public function setOrderedList($orderedList) {
		$this->orderedList = $orderedList;
	}

	public function setStartArticleName($startArticleName) {
		$this->startArticleName = $startArticleName;
	}

	public function setStartArticleIconClass($startArticleIconClass) {
		$this->startArticleIconClass = $startArticleIconClass;
	}

	public function setHideStartArticleName($hideStartArticleName) {
		$this->hideStartArticleName = $hideStartArticleName;
	}

	public function getNavigation() {
		global $REX;

		if ($this->orderedList) {
			$listType = 'ol';
		} else {
			$listType = 'ul';
		}

		if ($this->listId !== '') {
			$listIdAttribute = ' id="' . $this->listId . '"';
		} else {
			$listIdAttribute = '';
		}

		if ($this->listClass !== '') {
			$listClassAttribute = ' class="' . $this->listClass . '"';
		} else {
			$listClassAttribute = '';
		}

		$html = '<' . $listType . $listIdAttribute . $listClassAttribute . '>';
		$path = explode('|', $REX['ART'][$REX['ARTICLE_ID']]['path'][$REX['CUR_CLANG']] . $REX['ARTICLE_ID']);

		if ($REX['ARTICLE_ID'] !== $REX['START_ARTICLE_ID']) {
			$path = array_merge(array($REX['START_ARTICLE_ID']), $path);
		}

		foreach ($path as $id) {
			if ($id > 0) {
				$article = OOArticle::getArticleById($id);

				if ($article->isOnline()) {
					$linkText = $article->getName();
					$html .= '<li>';

					if (intval($id) === $REX['START_ARTICLE_ID']) {
						if ($this->hideStartArticleName) {
							$linkText = '';
						} else {
							if ($this->startArticleName != '') {
								$linkText = $this->startArticleName;
							}
						}

						if ($this->startArticleIconClass != '') {
							$linkText = '<i class="' . $this->startArticleIconClass . '"></i>' . $linkText;
						}
					}

					if (intval($id) === $REX['ARTICLE_ID']) {
						$html .= $linkText;
					} else {
						$html .= '<a href="' . $article->getUrl() . '">' . $linkText . '</a>';
					}

					$html .= '</li>';
				}
			}
		}

		$html .= '</' . $listType . '>';
		
		return $html;
	}
}

