Navigation Factory - Changelog
==============================

### Version 1.0.0 DEV

* Methode `setUlClass()` zur Klasse `rex_lang_nav` hinzugefügt, thx@darwin
* Methode `setLinkFromUserFunc()` in `setCustomLink()` umbenannt
* Klasse `nav42` umbenannt und aufgeteilt in `rex_nav`, `rex_lang_nav` und `rex_breadcrumb_nav`
* Alle Klassen geben die Navigation per `getNavigation()` aus.
* `getNavigationByCategory()` entfernt, stattdessen `setStartCategoryId()` hinzugefügt
* `getNavigationByLevel()` entfernt, stattdessen `setLevelStart()` hinzugefügt
* `setLevelDepth()` hinzugefügt
* `setLevelStart()` erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
