Sprachnavigation
================

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
