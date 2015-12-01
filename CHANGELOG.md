Navigation Factory - Changelog
==============================

### Version 1.0.2 DEV

* Fixed: Community Addon Permissions
* Fixed #2: `has-sub` in `rex_nav` wird jetzt dem Li zugewiesen, thx@alexwenz
* Neu: `setListMode()` zur `rex_breadcrumb_nav` hinzugefügt. Ergibt bei `false` eine reine Linkliste ohne ul/li's, thx@JeGr
* Verbessert: Bei gleichzeitiger Nutzung von `setStartLevel()` und `setStartCategoryId()` wird eine Warnung angezeigt

### Version 1.0.1 - 19. November 2015

* Updatehinweis: Addon bitte reinstallieren.
* Neu: Startseite mit Logo hinzugefügt

### Version 1.0.0 - 18. November 2015

* Geändert: Klasse `nav42` umbenannt und aufgeteilt in die Klassen `rex_nav`, `rex_lang_nav` und `rex_breadcrumb_nav`
* Geändert: Alle Methodennamen mit einem `Li` darin wurden umbenannt. `Li` = `ListItem`
* Geändert: Alle Methodennamen mit einem `Ul` darin wurden umbenannt. `Ul` = `List`
* Geändert: Alle Klassen geben einheitlich die Navigation über Ausgabemethode `getNavigation()` aus
* Geändert: `getNavigationByCategory()` entfernt, stattdessen `setStartCategoryId()` hinzugefügt
* Geändert: `getNavigationByLevel()` entfernt, stattdessen `setLevelStart()` hinzugefügt
* Geändert: `setLevelCount()` hinzugefügt, gibt die Anzahl der auszugebenden Levels an, beginned ab dem Start-Level bzw. der Start-Kategorie
* Geändert: `setLevelStart()` erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListClass()` (ehemals `setUlClass()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListId()` (ehemals `setUlId()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: Methode `setLinkFromUserFunc()` in `setCustomLink()` umbenannt
* Geändert: Es gab umfangreiche Änderungen an der Breadcrumb Navigation. Bitte die Codebeispiele studieren
* Neu: Methode `setListClass()` zur Klasse `rex_lang_nav` hinzugefügt, thx@darwin
* Neu: Methode `setShowHasSubClass()` zur Klasse `rex_nav` hinzugefügt, zeigt automatisch eine 'has-sub' Klasse für die Ul an
* Neu: Methode `setHasSubClass()` zur Klasse `rex_nav` hinzugefügt, zum ändern des Klassenmames. default ist 'has-sub'

