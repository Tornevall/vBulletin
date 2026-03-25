# vBulletin 6.2.0 – Svensk AI-översättning

AI-genererad översättning av vBulletins officiella engelska språkfil till **svenska (sv-SE)**.

Bas: `vbulletin-language.xml` (MASTER LANGUAGE, vBulletin 6.2.0)  
Översättning: `sv-se.xml` (Svenska, vBulletin 6.2.0)  
Datum: 2026-03-25

---

## Om översättningen

Alla fraser är maskinöversatta med AI (OpenAI) och har inte genomgått manuell korrekturläsning av en native speaker. Tekniska termer, forum-jargong och programnamn är i de flesta fall avsiktligt lämnade på engelska.

**Använd på eget ansvar.** Pull requests och korrigeringar välkomnas.

---

## Filer

| Fil | Beskrivning |
|-----|-------------|
| `vbulletin-language.xml` | Originalet – MASTER LANGUAGE (engelska, vBulletin 6.2.0) |
| `sv-se.xml` | AI-översatt till svenska (sv-SE, vBulletin 6.2.0) |

---

## Täckning

| | Original | Översatt |
|-|----------|----------|
| Fraser (`<phrase>`) | 10 629 | 9 630 |
| Kategorigrupper (`<phrasetype>`) | 64 | 63 |

Notera: Grupperna `cphelptext` och `pagemeta` är exkluderade i båda filerna (markerade som `<skippedgroups>` av vBulletin:s exportverktyg).

### Täckta kategorigrupper

<details>
<summary>Visa alla 63 grupper</summary>

| Grupp | Område |
|-------|--------|
| `advertising` | Annonshantering |
| `album` | Fotoalbum |
| `banning` | Banningar och restriktioner |
| `bbcode` | BBCode-taggar |
| `calendar` | Kalender |
| `ckeditor` | CKEditor (WYSIWYG-redigerare) |
| `cpcms` | Kontrollpanel – CMS |
| `cpglobal` | Kontrollpanel – Globalt |
| `cphome` | Kontrollpanel – Startsida |
| `cpoption` | Kontrollpanel – Inställningar |
| `cppermission` | Kontrollpanel – Behörigheter |
| `cprank` | Kontrollpanel – Rang |
| `cpuser` | Kontrollpanel – Användare |
| `cpusergroup` | Kontrollpanel – Användargrupper |
| `cron` | Schemalagda uppgifter |
| `diagnostic` | Diagnostik |
| `emailbody` | E-postmeddelanden – Brödtext |
| `emailsubject` | E-postmeddelanden – Ämnesrader |
| `error` | Felmeddelanden |
| `faqtext` | FAQ – Texter |
| `faqtitle` | FAQ – Rubriker |
| `forum` | Forum – Allmänt |
| `forumdisplay` | Forumvisning |
| `fronthelp` | Hjälp – Frontend |
| `frontredirect` | Omdirigeringar – Frontend |
| `global` | Globala fraser |
| `help_faq` | Hjälp / FAQ |
| `hooks` | Plugin-hooks |
| `infraction` | Varningar och infractions |
| `inlinemod` | Inline-moderering |
| `language` | Språkinställningar |
| `logging` | Loggar och händelser |
| `maintenance` | Underhåll |
| `messaging` | Meddelanden |
| `moderator` | Moderatorverktyg |
| `navbarlinks` | Navigationslänkar |
| `notice` | Noteringar och notiser |
| `pm` | Privata meddelanden |
| `poll` | Omröstningar |
| `postbit` | Inläggsvyn |
| `posting` | Inläggsformuläret |
| `prefix` | Tråd- och forumprefix |
| `prefixadmin` | Prefix-administration |
| `profilefield` | Profilfält |
| `promotion` | Användarpromotioner |
| `register` | Registrering |
| `reputation` | Rykte/betyg |
| `search` | Sök |
| `showthread` | Tråd-/inläggsvisning |
| `socialgroups` | Sociala grupper |
| `sql` | SQL / databasfel |
| `stats` | Statistik |
| `style` | Stilar och teman |
| `subscription` | Prenumerationer |
| `tagscategories` | Taggar och kategorier |
| `thread` | Trådar – Allmänt |
| `threadmanage` | Trådhantering |
| `timezone` | Tidszoner |
| `user` | Användarprofil |
| `vb5blog` | Blogg |
| `vbblock` | Blockmoduler |
| `vbsettings` | vBulletin-inställningar |
| `wol` | Vilka är online |

</details>

---

## Installation

1. Logga in på **vBulletin Admin Control Panel**.
2. Gå till **Languages & Phrases → Add New Language**.
3. Klicka på **Import XML** och välj `sv-se.xml`.
4. Sätt önskad status (aktiv/inaktiv) och spara.
5. Välj det importerade språket som standard för forumet eller låt användare välja det själva.

---

## Kända begränsningar

- Översättningen är **inte korrekturläst** av en mänsklig translator.
- Vissa fraser kan låta formella eller stela jämfört med en manuell översättning.
- Fraser som innehåller HTML, BBCode eller platshållare (`{1}`, `{2}` osv.) är i de flesta fall korrekt hanterade, men bör verifieras i kritiska e-postmallar och felmeddelanden.
- Tekniska termer som *thread*, *post*, *infraction*, *usergroup* m.fl. kan vara inkonsekvent översatta.

---

## Licens och upphovsrätt

vBulletin och dess MASTER LANGUAGE är upphovsrättsligt skyddade av **vBulletin Solutions, Inc.**
Den här AI-genererade översättningsfilen är skapad av **Thomas Tornevall** och distribueras fritt för personal/community-bruk.  
Denna fil är **inte** officiellt godkänd eller stödd av vBulletin Solutions.

---

## Bidrag

Hittar du en felöversättning? Öppna ett ärende eller skicka en pull request med korrigering mot rätt `<phrase>`-nod i `sv-se.xml`.

