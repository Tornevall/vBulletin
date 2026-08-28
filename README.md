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
| `tools-sso.php` | Liten fristående SSO-brygga från en redan inloggad vBulletin-användare till Tools |
| `TOOLS-SSO.md` | Kontrakt, säkerhetsgränser och driftsättning för Tools SSO-bryggan |

---

## Tools SSO-brygga

`tools-sso.php` är ett separat tillägg och ändrar inte vBulletins vendor-kod. Den används när en redan inloggad forum-medlem väljer vBulletin som inloggningsmetod i Tools.

Flödet är avsiktligt smalt:

1. Tools skapar ett kortlivat engångs-`state` som är bundet till den webbläsarsession som startade inloggningen.
2. Forumet verifierar användaren via sin befintliga server-side session.
3. Bryggan signerar en kortlivad assertion med stabilt forum-`userid`, `state`, audience, timestamps och nonce.
4. Username och e-post skickas inte i redirecten. Tools hämtar den identiteten via sin betrodda forumintegration efter att signaturen har verifierats.
5. Callbacken sker som en top-level HTTPS-redirect så Tools kan verifiera den ursprungliga sessionen under normal SameSite=Lax-policy.

Bryggan kräver ett delat signeringssecret i driftsättningsmiljön och kan få callback-URL via miljökonfiguration. Inga riktiga secrets ska lagras i repositoryt. Se `TOOLS-SSO.md` för det fulla kontraktet.

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
| `cpusergroup` | Användargrupper |
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

## Installation av språkfilen

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
- Tools SSO-bryggan kräver motsvarande Tools-side implementation och korrekt driftsättningskonfiguration innan live-inloggning kan användas.

---

## Licens och upphovsrätt

vBulletin och dess MASTER LANGUAGE är upphovsrättsligt skyddade av **vBulletin Solutions, Inc.**
Den här AI-genererade översättningsfilen är skapad av **Thomas Tornevall** och distribueras fritt för personal/community-bruk.  
Denna fil är **inte** officiellt godkänd eller stödd av vBulletin Solutions.

---

## Bidrag

Hittar du en felöversättning eller ett problem i de Tornevall-underhållna integrationsfilerna? Öppna ett ärende eller skicka en pull request med korrigering mot rätt fil.
