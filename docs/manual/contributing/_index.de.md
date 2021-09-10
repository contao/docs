---
title: "Zur Dokumentation beitragen"
description: "Hier erfährst du wie du zur Dokumentation beitragen kannst."
url: "beitragen"
aliases:
    - /de/beitragen/
weight: 300
---

## Vor deinem ersten Beitrag

Bevor du an der Dokumentation mit schreiben kannst, musst du noch folgendes tun:

- Erstelle ein kostenloses Konto bei [GitHub](https://github.com/join). [GitHub](https://de.wikipedia.org/wiki/GitHub) 
ist ein Dienst für die Versionsverwaltung mit [Git](https://de.wikipedia.org/wiki/Git) für Software-Projekte und beheimatet 
unter anderem die [Contao-Dokumentation](https://github.com/contao/docs/).
- Die Dokumentation wird in [Markdown](https://de.wikipedia.org/wiki/Markdown) geschrieben, mache dich mit der 
[Syntax](https://docs.contao.org/manual/de/artikelverwaltung/inhaltselemente/#syntax) dieser Auszeichnungssprache 
vertraut.


## Kleine Fehler korrigieren

Wenn du während des Lesens der Dokumentation einen Tippfehler entdeckst oder etwas umformulieren möchtest, ist es am 
einfachsten, dies direkt über GitHub zutun.


### Seite bearbeiten und Fork des Repositories erstellen

Klicke auf den Link »Diese Seite bearbeiten« in der oberen rechten Ecke und du wirst zu GitHub weitergeleitet:

![Diese Seite bearbeiten](/de/contributing/images/de/diese-seite-bearbeiten.png?classes=shadow)

Bei deinem ersten Beitrag wirst du gebeten, einen [Fork](https://de.wikipedia.org/wiki/Abspaltung_(Softwareentwicklung)) 
vom [Repository](https://de.wikipedia.org/wiki/Repository) »contao/docs« zu erstellen. Klicke auf »Fork this repository«.

![Fork this repository](/de/contributing/images/de/fork-this-repository.png?classes=shadow)


### Inhalt bearbeiten

Bearbeite den Inhalt, beschreibe deine Änderungen und klicke auf die Schaltfläche »Propose file change«.

![Bearbeite den Inhalt](/de/contributing/images/de/inhalt-bearbeiten.png?classes=shadow)


### Branch und Commit erzeugen

GitHub wird nun einen Branch und einen Commit für deine Änderungen erzeugen. Ausserdem wird eine Vorschau deiner 
Änderungen angezeigt:

![Branch und Commit erzeugen](/de/contributing/images/de/branch-und-commit-erzeugen.png?classes=shadow)

Wenn alles korrekt ist, klicke auf die Schaltfläche »Create pull request«.

{{% notice info %}}
Im verteilten Versionierungssystem Git und somit auch auf GitHub werden Vorschläge als sog. »Pull-Requests« erstellt. 
Da du keine Berechtigungen hast, direkt Änderungen im offiziellen Repository zu vollziehen (»to commit«), stellst du 
eine Anfrage (engl. »Request«) an die Berechtigten des Repositories, deine Änderungen in das offizielle Repository zu 
»ziehen« (engl. »to pull«).
{{% /notice %}}


### Pull-Request erzeugen

Auf der nächsten Seite kannst du, falls nötig, noch letzte Anpassungen an deinen Pull-Request vornehmen. 
Klicke erneut auf die Schaltfläche »Create pull request«.

![Pull-Request erzeugen](/de/contributing/images/de/create-pull-request.png?classes=shadow)

**Herzlichen Glückwunsch!** Du hast soeben einen Pull-Request für die offizielle Contao-Dokumentation erstellt! Die 
Community wird nun deinen Pull-Request überprüfen und (möglicherweise) Änderungen vorschlagen.


### Fork aktualisieren

Falls du weitere Änderungen vorschlagen möchtest, überprüfe zuvor, ob dein Fork auf dem aktuellen Stand ist.
Über GitHub kannst du dann deinen Fork über »Fetch upstream« synchronisieren.

![GitHub Fetch upstream](/de/contributing/images/de/github-fork-fetch-upstream.png?classes=shadow)


## Einen Beitrag für die Dokumentation schreiben

Wenn du einen umfangreichen Beitrag planst oder du es vorziehst, an deinem eigenen Computer zu arbeiten, lese hier weiter 
und wir zeigen dir eine alternative Möglichkeit auf, wie du Pull-Requests an die Contao-Dokumentation senden kannst.

### Git installieren

Dazu musst du [Git auf deinem Betriebsystem installieren](https://git-scm.com/book/de/v2/Erste-Schritte-Git-installieren).


### Fork des Repositories erstellen

Wenn du noch kein Konto bei GitHub hast, [erstelle](https://github.com/join) eines und wechsle zum 
offiziellen Contao-Dokumentations-Repository unter [github.com/contao/docs](https://github.com/contao/docs). Klicke auf 
die Schaltfläche »[Fork](https://help.github.com/en/github/getting-started-with-github/fork-a-repo)«, um das Repository 
auf dein persönliches Konto zu übertragen. Dies ist nur erforderlich, wenn du zum ersten Mal etwas zur Dokumentation 
beiträgst.

![Fork this repository](/de/contributing/images/de/fork-this-repository.png?classes=shadow)


### Klone das geforkte Repository 

Klone das geforkte Repository auf deinem lokalen Rechner:

Erstelle ein Verzeichnis mit dem Namen `contao` und wechsle mit **c**hange **d**irectory  in dieses.

```bash
cd contao
```

Beim Klonen installierst du das Hugo Learn Theme als Submodul von git.

```bash
git clone --recurse-submodules git@github.com:DEIN-GITHUB-BENUTZERNAME/docs.git
```

oder

```bash
git clone --recurse-submodules https://github.com/DEIN-GITHUB-BENUTZERNAME/docs.git
```


### Hugo-Site-Generator installieren

Die Dokumentation wird mit dem [Hugo-Site-Generator](https://gohugo.io/) erstellt, daher musst du 
[Hugo](https://gohugo.io/getting-started/installing/) zuerst auf deinem System installieren. Falls du Hugo bereits zu 
einem früheren Zeitpunkt installiert hast, empfiehlt sich eine 
[Aktualisierung der Software](https://gohugo.io/getting-started/installing/#upgrade-hugo).


### Vorschau der Dokumentation erstellen

Das Erstellen einer Vorschau der Dokumentation erfolgt mit dem `make`-Befehl. Es stehen verschiedene Befehle zur 
Verfügung, je nachdem, welchen Teil der Dokumentation du bauen möchtest.

```bash
make build-dev
make build-manual
```

Erstellt die gesamte Dokumentation im `Build`-Verzeichnis.

```bash
make live-dev
make live-manual
```

Erstellt eine Live-Vorschau, welche automatisch Änderungen im Verzeichnis `docs` verfolgt und das Frontend neu 
lädt. Das Frontend ist über [localhost:1313](http://localhost:1313) erreichbar.


```bash
make clean
```

Bereinigt das `Build`-Verzeichnis.

{{% notice tip %}}
Alternativ kannst du die lokale Vorschau auch ohne `make`-Befehl erstellen. Auf der Konsole wechselst du 
hierzu in das Unterverzeichnis `page` und erstellst die lokale Vorschau über den Befehl: 
`hugo server --cleanDestinationDir --environment manual --destination ../build/manual`. 
{{% /notice %}}


## Fork mit dem Original-Repository synchronisieren

Wenn du schon länger nicht mehr mit deinem Fork gearbeitet hast, kann es sein, dass bei deinem Fork auf GitHub folgende 
Meldung `This branch is 7 commits behind contao:main.` ausgegeben wird.


Bevor du also Anpassungen an der Doku vernimmst, kannst du dafür sorgen, dass dein Fork mit dem Original-Repository 
synchronisiert wird.

Wechsle mit `cd` in den Klone des geforkten Repositories.

```bash
cd docs
```

Füge das Original-Repository einmalig als neues Remote-Repository hinzu und gebe es als Upstream-Repository an.


```bash
git remote add upstream https://github.com/contao/docs.git
```

{{% notice info %}}
Der [Remote-Name](https://docs.github.com/en/github/using-git/renaming-a-remote) »upstream« kann frei gewählt werden bzw. 
auch nachträglich umbenannt werden.
{{% /notice %}}

Hole die Daten des Upstream-Repositories mit `fetch`.


```bash
git fetch upstream

```

Die Commits, die sich von deinem Fork unterscheiden, sind jetzt in deiner lokalen Umgebung in getrennten Branches 
untergebracht. Mit dem nächsten Befehl führst du diese zusammen.


```bash
git merge upstream/main
```

Jetzt führst du noch folgendes Kommando aus, um deinen Fork zu aktualisieren.


```bash
git push
```

Auf GitHub wird bei deinem Fork jetzt die Meldung `This branch is even with contao:main.` ausgegeben.



### Branch erstellen

Bevor du den Inhalt bearbeitest, sorgen wir mit dem Erstellen eines eigenen Branches (Verweis auf einen Snapshot) dafür, 
dass du mit anderen parallel an der Dokumentation arbeiten kannst. Branches sind also unabhängige Entwicklungszweige.

Erstelle einen neuen Branch aus dem aktuellen.


```bash
git checkout -b DEIN-BRANCHNAME
```


### Inhalt bearbeiten

Nachdem die Grundvoraussetzung zum Dokumentieren erfüllt sind, kannst du die Doku jetzt mit deinem 
Beitrag erweitern.

Die Dateien der Dokumentation findest du im Verzeichnis `docs` deiner lokalen Hugo-Installation.

- Die Contao Entwicklerdokumentation befindet sich im Verzeichnis `dev`.
- Das Contao Handbuch für Anwender*innen befindet sich im Verzeichnis `manual`.

Wenn alle Anpassungen bzw. Ergänzungen vorgenommen wurden, spielen wir diese auf unseren Fork zurück.


### Änderungen in dein Repository übertragen {#aenderungen-in-dein-repository}

Jetzt liegen die Daten auf deinem lokalen Rechner und müssen im nächsten Schritt an dein Repository auf GitHub 
übertragen werden.

Mit folgendem Befehl kannst du alle Änderungen für den nächsten Commit stagen.

```bash
git add .
```

Danach fügst du die Änderungen dem Lokalen-Repository hinzu.

```bash
git commit -m "Eine aussagekräftige Commit-Nachricht eingeben"
```

Um die Änderungen an dein entferntes Repository zu senden, führe folgenden Befehl aus.

```bash
git push origin DEIN-BRANCHNAME
```

{{% notice info %}}
Nach dem »push« eines eigenen neuen Branches wird dir auf der Konsole ein Link zum Erstellen des Pull-Request angezeigt.
{{% /notice %}}


### Pull-Request erzeugen

Rufe deinen Fork auf GitHub (https://github.com/DEIN-GITHUB-BENUTZERNAME/docs) auf.

Klicke in der Mitteilung auf »Pull request.

![GitHub-Mitteilung](/de/contributing/images/de/github-message.png?classes=shadow)

Vergleiche die Änderungen und schliesse diesen Schritt mit dem Klick auf »Create pull request« ab.

![Änderungen vergleichen](/de/contributing/images/de/comparing-changes.png?classes=shadow)

Bestätige das Erstellen eines Pull requests mit »Create pull request«.

![Pull-Request erzeugen](/de/contributing/images/de/open-a-pull-request.png?classes=shadow)

**Herzlichen Glückwunsch!** Du hast soeben einen Pull-Request für die offizielle Contao-Dokumentation erstellt! Die 
Community wird nun deinen Pull-Request überprüfen und (möglicherweise) Änderungen vorschlagen.


