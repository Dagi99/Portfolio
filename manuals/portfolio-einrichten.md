# Portfolio Dagi `einrichten`
> Diese Anleitung beschreibt, was dieses Theme gegenüber dem Starter-Theme ergänzt und wie die Inhalte im Backend erfasst werden, damit die Seite wie im Mockup aussieht.

## 🧩 Was das Theme mitbringt

| Bereich | Slug / Datei | Zweck |
| --- | --- | --- |
| Custom Post Type | `collection` · [backend/cpt/_collection.php](/backend/cpt/_collection.php) | Ein Eintrag = ein Projekt. URL: `/work/projektname/` |
| Taxonomie | `collection_discipline` | Disziplin, steuert Filter und Kanäle (CH 01–04) |
| Taxonomie | `collection_tool` | Tools auf Karte und Case Study |
| Taxonomie | `collection_role` | "My role" in der Case Study |
| Menu | `main` | Hauptnavigation im Header, letzter Eintrag = Pill-Button |
| Menu | `footer` | Impressum, Datenschutz |
| Globales | [backend/carbonfields/_globals.php](/backend/carbonfields/_globals.php) | Ort-Label, Verfügbarkeit, E-Mail, Social Links, Footer-Texte |
| Projektdetails | [backend/carbonfields/_collection.php](/backend/carbonfields/_collection.php) | Kurzbeschreibung, Jahr, Typ, Untertitel, Team, Thumbnail, Hover-Loop |
| Kanal | [backend/carbonfields/_collection_discipline.php](/backend/carbonfields/_collection_discipline.php) | Kanal-Nummer pro Disziplin |

### Module
Alle Module stehen auf **Seiten** und auf **Projekten der Collection** zur Verfügung.

| Modul | Slug | Verwendung |
| --- | --- | --- |
| Hero | `hero` | Startbild mit grosser Headline (One-Pager) |
| About | `about` | Vorstellung + Kanäle aus den Disziplinen |
| Work | `work` | Projekt-Grid mit Filter, lädt die Collection |
| Kontakt | `contact` | Headline, E-Mail, Socials, Contact-Form-7-Formular |
| Kapitel | `chapter` | Nummeriertes Kapitel einer Case Study (01 The idea …) |
| Film | `film` | Vimeo/YouTube-Link oder eigene MP4-Datei |
| Galerie | `gallery` | Film-Stills, 2 oder 3 Spalten |
| Soundtrack | `soundtrack` | Audio-Player mit Wellenform |
| Text | `text` | Fliesstext, z.B. Impressum und Datenschutz |

## ⚒️ Schritt-für-Schritt-Anleitung
1. **Plugins** installieren und aktivieren: Carbon Fields (wie im Unterricht), Contact Form 7. Optional: Flamingo (speichert Nachrichten), WP Mail SMTP (zuverlässiger Versand).
2. Theme aktivieren und unter `Einstellungen > Permalinks` einmal speichern.
3. Unter `Collection > Disziplinen` die Disziplinen anlegen, jeweils mit **Beschreibung** (ein Satz) und **Kanal-Nummer**:
   - Motion design (1), Broadcast UI (2), Installations (3), Film & sound (4)
4. Unter `Globales` E-Mail, Social Links und Verfügbarkeit erfassen.
5. Pro Projekt unter `Collection > Neues Projekt`:
   - Titel, Kurzbeschreibung, Jahr, Typ
   - Thumbnail (16:10, mind. 1600 px breit), optional Hover-Loop (MP4, ohne Ton, 4–6 s)
   - Disziplin, Tools und Rollen rechts in der Seitenleiste
   - Reihenfolge rechts unter "Seitenattribute" (10, 20, 30 …)
   - Für eine Case Study: im Bereich **Module** Film, Kapitel, Soundtrack und Galerie hinzufügen. Ohne Case Study: im Tab "Case Study" das Häkchen entfernen, dann verlinkt die Karte nicht.
6. Eine Seite **Start** anlegen mit den Modulen Hero, About, Work, Kontakt (in dieser Reihenfolge). Unter `Einstellungen > Lesen` als Startseite festlegen.
7. In **Contact Form 7** ein Formular anlegen (Vorlage unten) und den Shortcode im Kontakt-Modul einfügen.
8. Seiten **Impressum** und **Datenschutz** mit dem Text-Modul anlegen.
9. Unter `Design > Menus` zwei Menus anlegen:
   - **Hauptnavigation** (Position `main`): eigene Links `/#about`, `/#work`, `/#contact` mit den Titeln About, Work, Contact
   - **Footer** (Position `footer`): Impressum, Datenschutz

### Formular-Vorlage für Contact Form 7
```text
<label> Name [text* your-name autocomplete:name] </label>
<label> Email [email* your-email autocomplete:email] </label>
<label> What's it about?
  [select your-topic "Internship" "Freelance project" "Collaboration" "Just saying hi"] </label>
<label> Message [textarea* your-message x6] </label>
[acceptance privacy] I have read the <a href="/datenschutz/">privacy policy</a>. [/acceptance]
[submit "Send message →"]
```

## 💡 Hinweise
- Die Anker-Links im Menu immer mit Schrägstrich schreiben (`/#work`), sonst funktionieren sie auf den Case-Study-Seiten nicht.
- Hover-Loops als MP4 (H.264) exportieren. Eine 4-MB-GIF wird als MP4 etwa 10–20-mal kleiner.
- Die Schriften liegen lokal in `frontend/assets/fonts/` (keine Verbindung zu Google).
- Disziplinen ohne Projekte erscheinen nicht im Filter, aber im About-Modul.
