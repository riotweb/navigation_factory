Hauptnavigation
===============

Ausgabe des 1. Navigationslevels
--------------------------------

```php
$nav = new rex_nav();

$nav->setStartLevel(1); // startet bei level 1
$nav->setLevelDepth(1); // 1 level tief vom start level aus

echo $nav->getNavigation();

```

Ausgabe des 2. und 3. Navigationslevels
---------------------------------------

```php
$nav = new rex_nav();

$nav->setStartLevel(2); // startet bei level 2
$nav->setLevelDepth(2); // 2 level tief vom start level aus

echo $nav->getNavigation();
```

Ausgabe der Navigation mit Startkategorie-Id = 42
-------------------------------------------------

```php
$nav = new rex_nav();

$nav->setStartCategoryId(42); // startet bei kategorie id = 42
$nav->setLevelDepth(1); // 1 level tief von start kategorie aus

echo $nav->getNavigation();
```


Alle möglichen Methoden und Paramater der rex_nav Klasse
--------------------------------------------------------

```php
$nav = new rex_nav();

$nav->setStartCategoryId(42); // die startkategorie
$nav->setLevelDepth(2); // 2 level tief
$nav->setShowAll(true); // alle unterebenen werden angezeigt
$nav->setIgnoreOfflines(false); // offline artikel werden angezeigt
$nav->setHideWebsiteStartArticle(true); // startartikel der website wird ausgeblendet
$nav->setHideIds(array(42, 108)); // kategorien mit ids 42 und 108 werden ausgeblendet
$nav->setSelectedClass("current"); // li klasse für selektierte menüpunkte: "current"
$nav->setActiveClass("current active"); // li klasse für gerade aktiven menüpunkt: "current active"
$nav->setUlId("nav", 1); // erste ul id: "nav"
$nav->setUlClass("sf-menu", 1); // erste ul klasse "sf-menu"
$nav->setLiClass("list-item"); // li klasse "list-item"
$nav->setLiIdFromMetaField("cat_css_id"); // li id aus metainfo feld: "cat_css_id"
$nav->setLiClassFromMetaField("cat_css_class"); // li klasse aus metainfo feld: "cat_css_class"
$nav->setLiIdFromCategoryId(array(42 => "foo", 108 => "bar")); // li id anhand artikel id
$nav->setLiClassFromCategoryId(array(42 => "the-class")); // li klasse anhand artikel id
$nav->setCustomLink(function($cat, $depth) { // gesamter link anhand php funktion
    if ($depth == 1) {
		// hier als beispiel: erste ebene ohne verlinkung
        return htmlspecialchars($cat->getName());
    } else {
		// alle anderen ebenen werden normal verlinkt
        return '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
    }
});

echo $nav->getNavigation();
```
