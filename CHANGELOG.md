Navigation Factory - Changelog
==============================

### Version 1.0.0 DEV

* Geändert: Klasse `nav42` umbenannt und aufgeteilt in die Klassen `rex_nav`, `rex_lang_nav` und `rex_breadcrumb_nav`
* Geändert: Alle Methodennamen mit einem `Li` darin wurden umbenannt. `Li` = `ListItem`
* Geändert: Alle Methodennamen mit einem `Ul` darin wurden umbenannt. `Ul` = `List`
* Geändert: Alle Klassen geben einheitlich die Navigation über Ausgabemethode `getNavigation()` aus
* Geändert: `getNavigationByCategory()` entfernt, stattdessen `setStartCategoryId()` hinzugefügt
* Geändert: `getNavigationByLevel()` entfernt, stattdessen `setLevelStart()` hinzugefügt
* Geändert: `setLevelDepth()` hinzugefügt
* Geändert: `setLevelStart()` erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListClass()` (ehemals `setUlClass()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListId()` (ehemals `setUlId()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: Methode `setLinkFromUserFunc()` in `setCustomLink()` umbenannt
* Geändert: Es gab umfangreiche Änderungen an der Breadcrumb Navigation. Bitte die Codebeispiele studieren
* Neu: Methode `setListClass()` zur Klasse `rex_lang_nav` hinzugefügt, thx@darwin
