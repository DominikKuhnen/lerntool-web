# 🧠 Lerntool Web – Wartungswissen interaktiv

> Die moderne Web-Version des Excel-basierten Maintenance-Lerntools  
> mit Mehrbenutzer-Unterstützung, Single-Sign-On und prüfbarem Wissenstransfer.

---

## 📌 Ziel

**Lerntool Web** ist eine browserbasierte Lernplattform zur Schulung und Wissensweitergabe in der technischen Instandhaltung. Sie kombiniert:

- Interaktives Fragenlernen
- Merksystem & Feedbackfunktion
- Wissenserweiterung durch Mitarbeiter
- Rollenbasiertes Prüfverfahren
- Fortschrittsprotokollierung
- Abteilungsbezogene Darstellung
- Versionskontrolle mit Ablaufdatum

---

## 🚀 Features

✅ Lernen nach verschiedenen Strategien:
- Zufall, Kategorie, Neueste, Gemerkte  
- Fragen mit Antwortauswahl & Tipps im Klartext

✅ Wissen hinzufügen:
- Neue Fragen oder Tipps per Formular  
- Automatische ID-Vergabe & Kategorisierung

✅ Prüfung & Freigabe:
- Admins und Prüfer geben Inhalte frei  
- Ablehnung mit Kommentar & Wiedereinreichung

✅ Lernverlauf & Statistik:
- Gesehene Einträge pro Benutzer  
- Tageszähler (z. B. DKU_Fr, DKU_Ti)

✅ Benutzer- & Rollensystem:
- Single Sign-On via Windows-Kürzel  
- Rechte: Lesen | Schreiben | Prüfen | Admin

---

## 🧩 Projektstruktur

```bash
lerntool-web/
├── public/              # Bilder, Icons, Favicon
├── src/
│   ├── components/      # UI-Bausteine (Buttons, Labels, Menüs)
│   ├── pages/           # Routen: Startmenü, Lernen, Hinzufügen, Prüfen etc.
│   ├── services/        # Zugriff auf Daten (CSV, API, DB)
│   ├── context/         # Benutzerzustand, Rollenverwaltung
│   ├── types/           # Datentypen: Frage, Tipp, Benutzer, Rolle
│   └── utils/           # Hilfsfunktionen (ID-Ermittlung, Validierung)
├── data/                # CSV-Datenbanken
│   ├── fragen.csv
│   ├── tipps.csv
│   ├── lernverlauf_fragen.csv
│   ├── lernverlauf_tipps.csv
│   ├── mitarbeiter2.csv
│   └── kategorien.csv
└── README.md