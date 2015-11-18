Navigation Factory AddOn für REDAXO 4
=====================================

Erweitere und modifizierte rex_navigation Klasse mit Zusatzfunktionen.

Features
--------

* Ausgabe der Navigation von einer Katagorie aus oder über Kategorie-Levels
* Es wird zuerst eine nackte Ul-Liste ohne Klassen oder Ids ausgegeben
* Artikel (z.B. Home) können ausgeblendet werden
* Einstellen der CSS-Klasse für selektierte Menüpunkte (z.B. `current`)
* Jede UL kann eine Klasse und/oder Id zugewiesen bekommen (Suckerfish/Superfish)
* Angabe von MetaInfo Felder aus denen Klassen und Ids für die Li's herausgezogen werden
* Aufruf einer benutzerdef. PHP-Funktion möglich, die den Inhalt der Li's zurückgibt
* Unterstützung für alle URL-Typen von SEO42
* Reagiert automatisch auf gesperrte Artikel etc. bei installiertem Community AddOn
* Ausgabe einer einfachen Sprachnavigation möglich
* Ausgabe einer Breadcrumb Navigation möglich

PHP Klassen
------------

* `rex_nav` Klasse für die Ausgabe von Hauptnavigationen
* `rex_lang_nav` Klasse für die Ausgabe von Sprachnavigationen
* `rex_breadcrumb_nav` Klasse für die Ausgabe von Breadcrumb Navigationen

Codebeispiele
-------------

Die Codebeispiele sind direkt im Addon als Menüpunkt aufrufbar. Alternativ sind diese auch im `docs` Ordner des Addons zu finden.

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
