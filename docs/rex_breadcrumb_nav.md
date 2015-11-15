Breadcrumb Navigation
=====================

Ausgabe einer Breadcrumb Navigation
-----------------------------------

```php
$breadcrumbNav = new rex_breadcrumb_nav();

$nav->setCssClass("breadcrumb"); // ul klasse: "breadcrumb"
$nav->setOlList(false); // es wird eine ul liste ausgegeben
$nav->setStartArticleName("<i class='fa fa-home'></i>"); // ausgabe mit font-awesome icon

echo $breadcrumbNav->getNavigation();
```
