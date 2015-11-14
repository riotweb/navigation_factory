Codebeispiele
=============

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


Alle Methoden und Paramater der rex_nav Klasse
----------------------------------------------

```php
$nav = new rex_nav();

$nav->setStartCategory(42);
$nav->setLevelDepth(2); // 2 level tief
$nav->setShowAll(true); // alle unterebenen werden angezeigt
$nav->setIgnoreOfflines(true); // offline artikel werden nicht angezeigt
$nav->setHideWebsiteStartArticle(false); // startartikel der website wird nicht ausgeblendet
$nav->setHideIds(array(42, 108)); // kategorien mit ids 42 und 108 werden ausgeblendet
$nav->setSelectedClass("current"); // li klasse für selektierte menüpunkte: "current"
$nav->setActiveClass("current active"); // li klasse für gerade aktiven menüpunkt: "current active"
$nav->setUlId("nav", 0); // erste ul id: "nav"
$nav->setUlClass("sf-menu", 0); // erste ul klasse "sf-menu"
$nav->setLiClass("list-item"); // li klasse "list-item"
$nav->setLiIdFromMetaField("cat_css_id"); // li id aus metainfo feld: "cat_css_id"
$nav->setLiClassFromMetaField("cat_css_class"); // li klasse aus metainfo feld: "cat_css_class"
$nav->setLiIdFromCategoryId(array(42 => "foo", 108 => "bar")); // li id anhand artikel id
$nav->setLiClassFromCategoryId(array(42 => "the-class")); // li klasse anhand artikel id
$nav->setCustomLink(function($cat, $depth) { // php funktion die den link zurückgibt (hier als beispiel: erste ebene ohne verlinkung)
    if ($depth == 1) {
        return htmlspecialchars($cat->getName());
    } else {
        return '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
    }
});

echo $nav->getNavigation();
```

Ausgabe einer einfachen Sprachnavigation
----------------------------------------

```php
$langNav = new rex_lang_nav();

$nav->setUlId("lang-nav"); // ul id: "lang-nav"
$nav->setUlClass("my-lang-class"); // ul class: "my-lang-class"
$nav->setselectedClass("current"); // li klasse für selektierten menüpunkt: "current"
$nav->setshowLiIds(true); // zusätzliche, eindeutige li id's werden ausgegeben
$nav->sethideLiIfOfflineArticle(false); // bei einem offline artikel li nicht verstecken sondern auf startartikel der website verlinken
$nav->setuseLangCodeAsLinkText(true); // langcode anstelle sprachname als linktext ausgeben
$nav->setupperCaseLinkText(true); // linktext in großbuchstaben anzeigen

echo $langNav->getNavigation();
```

Ausgabe einer Breadcrumb Navigation
-----------------------------------

```php
$breadcrumbNav = new rex_breadcrumb_nav();

$nav->setCssClass("breadcrumb"); // ul klasse: "breadcrumb"
$nav->setOlList(false); // es wird eine ul liste ausgegeben
$nav->setStartArticleName("<i class='fa fa-home'></i>"); // ausgabe mit font-awesome icon

echo $breadcrumbNav->getNavigation();
```
