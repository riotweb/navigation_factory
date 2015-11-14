Navigation Factory AddOn für REDAXO 4
=====================================

!!! Hinweis: Addon befindet sich im Aufbau. !!!
!!! Nicht für den Produktiveinsatz geeignet !!!

Erweitere und modifizierte rex_navigation Klasse mit Zusatzfunktionen.

Features
--------

* Ausgabe der Navigation von einer Katagorie aus oder über Kategorie-Levels
* Es wird zuerst eine nackte UL-Liste ohne Klassen oder Ids ausgegeben
* Artikel (z.B. Home) können ausgeblendet werden
* Einstellen der CSS-Klasse für selektierte Menüpunkte (z.B. `current`)
* Jede UL kann eine Klasse und/oder ID zugewiesen bekommen (Suckerfish/Superfish)
* Angabe von MetaInfo Felder aus denen Klassen und IDs für die LI's herausgezogen werden
* Aufruf einer benutzerdef. PHP-Funktion möglich, die den Inhalt der LI's zurückgibt
* Unterstützung für alle URL-Typen von SEO42
* Reagiert automatisch auf gesperrte Artikel etc. bei installiertem Community AddOn
* Ausgabe einer einfachen Sprachnavigation möglich
* Ausgabe einer Breadcrumb Navigation möglich
* Codebeispiele in der Hilfe von SEO42

Codebeispiele
-------------

```php
<div style="background:#fff">
 <?php 
// ausgabe des 1. navigationslevels
$nav = new rex_nav();
$nav->setLevelDepth(1);
echo $nav->getNavigationByLevel(0);

echo '<hr>';

// ausgabe des 2. und 3. navigationslevels
$nav = new rex_nav();
$nav->setLevelDepth(3);
echo $nav->getNavigationByLevel(1);

echo '<hr>';

// ausgabe der navigation mit startkategorie id = 42
$nav = new rex_nav();
$nav->setLevelDepth(2); // 2 level tief
echo $nav->getNavigationByCategory(42);

echo '<hr>';

// ausgabe der navigation mit startkategorie id = 42
$nav = new rex_nav();

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
$nav->setLiIdFromCategoryId(array(42 => "foo", 43 => "bar")); // li id anhand artikel id
$nav->setLiClassFromCategoryId(array(42 => "my-class")); // li klasse anhand artikel id
$nav->setCustomLink(function($cat, $depth) { // php funktion die den link zurückgibt (hier als beispiel: erste ebene ohne verlinkung)
    if ($depth == 1) {
        return htmlspecialchars($cat->getName());
    } else {
        return '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
    }
});

echo $nav->getNavigationByCategory(42);

echo '<hr>';

// ausgabe einer einfachen sprachnavigation
$nav = new rex_lang_nav();

$nav->setUlId("lang-nav"); // ul id: "lang-nav"
$nav->setUlClass("my-lang-class"); // ul class: "my-lang-class"
$nav->setselectedClass("current"); // li klasse für selektierten menüpunkt: "current"
$nav->setshowLiIds(true); // zusätzliche, eindeutige li id's werden ausgegeben
$nav->sethideLiIfOfflineArticle(false); // bei einem offline artikel li nicht verstecken sondern auf startartikel der website verlinken
$nav->setuseLangCodeAsLinkText(true); // langcode anstelle sprachname als linktext ausgeben
$nav->setupperCaseLinkText(true); // linktext in großbuchstaben anzeigen

echo $nav->getNavigation();

echo '<hr>';

// ausgabe einer breadcrumb navigation
$nav = new rex_breadcrumb_nav();

$nav->setCssClass("breadcrumb"); // ul klasse: "breadcrumb"
$nav->setOlList(false); // es wird eine ul liste ausgegeben
$nav->setStartArticleName("<i class='fa fa-home'></i>"); // ausgabe mit font-awesome icon

echo $nav->getNavigation();

echo '<hr>';
?> 
</div>
```

Hinweise
--------

* Getestet mit REDAXO 4.6
* AddOn-Ordner lautet: `navigation_factory`

Changelog
---------

siehe [CHANGELOG.md](CHANGELOG.md)

Lizenz
------

siehe [LICENSE.md](LICENSE.md)

Credits
-------

* [Parsedown](http://parsedown.org/) Class by Emanuil Rusev
