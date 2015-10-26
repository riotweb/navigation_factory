<?php

class rex_breadcrumb_nav {
	protected $cssClass;
	protected $olList;
	protected $startArticleName;

	public function __construct() {
		$this->cssClass = '';
		$this->olList = false;
		$this->startArticleName = '';
	}

	public function setCssClass($cssClass) {
		$this->cssClass = $cssClass;
	}

	public function setOlList($olList) {
		$this->olList = $olList;
	}

	public function setStartArticleName($startArticleName) {
		$this->startArticleName = $startArticleName;
	}

	public function getNavigation() {
		global $REX;

		$listType = 'ul';

		if ($this->olList) {
			$listType = 'ol';
		}

		if ($this->cssClass !== '') {
			$cssClass = ' class="' . $this->cssClass . '"';
		} else {
			$cssClass = '';
		}

		$html = '<' . $listType . $cssClass . '>';
		$path = explode('|', $REX['ART'][$REX['ARTICLE_ID']]['path'][$REX['CUR_CLANG']] . $REX['ARTICLE_ID']);

		if ($REX['ARTICLE_ID'] !== $REX['START_ARTICLE_ID']) {
			$path = array_merge(array($REX['START_ARTICLE_ID']), $path);
		}

		foreach ($path as $id) {
			if ($id) {
				if ($this->startArticleName === false && intval($id) === $REX['START_ARTICLE_ID']) {
					continue;
				}

				$article = OOArticle::getArticleById($id);
				$articleName = $article->getName();

				if ($article->isOnline()) {
					if ($this->startArticleName !== '' && intval($id) === $REX['START_ARTICLE_ID']) {
						$articleName = $this->startArticleName;
					}

					$html .= '<li>';

					if (intval($id) === $REX['ARTICLE_ID']) {
						$html .= $articleName;
					} else {
						$html .= '<a href="' . $article->getUrl() . '">' . $articleName . '</a>';
					}

					$html .= '</li>';
				}
			}
		}
		
		return $html .= '</' . $listType . '>';
	}
}

