#  Festivo - Evenementenplatform 

##  Projectoverzicht
Festivo is een evenementenplatform waar beheerders evenementen kunnen aanmaken, bewerken, verwijderen en voorzien van tags en afbeeldingen. Normale gebruikers kunnen evenementen bekijken, filteren en gedetailleerde informatie opvragen. Dit project past de core concepten toe van het Laravel framework, waaronder de MVC-architectuur, Eloquent ORM relaties, authenticatie en autorisatie.

---

## Standaard Admin Account (Seeder)
Voor de evaluatie is er een standaard admin-account geconfigureerd in de seeders:
- **Username:** `admin`
- **Email:** `admin@ehb.be`
- **Password:** `Password!321`

---

##  Technische Vereisten en Implementatie (Code Pointers)

Conform de exameneisen zijn de technische componenten als volgt geïmplementeerd in de code:

| Technische Vereiste | Beschrijving & Locatie in de Code |
| :--- | :--- |
| **Routes & Middleware** | Alle routes zijn gegroepeerd en beveiligd met de juiste middleware (zoals `auth` en admin-checks) in `routes/web.php`. |
| **Controllers (CRUD)** | Gecentraliseerd in `app/Http/Controllers/EventController.php` (grotendeels opgebouwd als resource controller). |
| **Eloquent Models & Relaties** | • **Many-to-Many:** Tussen `Event` en `Tag` via de pivot-tabel `event_tag` (`app/Models/Event.php` en `Tag.php`).<br>• **One-to-Many:** Aangepast waar van toepassing binnen de entiteiten. |
| **Database & Seeders** | Migraties en seeders staan in `database/migrations/` en `database/seeders/`. Ondersteunt volledig `php artisan migrate:fresh --seed`. |
| **Validatie & Beveiliging** | • **CSRF Protection:** Automatisch aanwezig in alle Blade formulieren via `@csrf`.<br>• **XSS Protection:** Standaard Blade escaping (`{{ $variable }}`).<br>• **Validatie:** Server-side validatie in FormRequests/Controllers. |
| **Views & Layouts** | Gepubliceerd met Blade templates (`resources/views/events/`), gebruikmakend van minimaal twee layouts en herbruikbare componenten. |

---

## Installatie en Lokale Setup

Volg onderstaande stappen om de applicatie lokaal te draaien:

### 1. Kloon de repository
```bash
git clone https://github.com/jouw-gebruikersnaam/festivo.git
cd festivo
```

### 2. Installeer dependencies via Composer
```bash
composer install
```

### 3. Configureer je Omgeving (.env)
Kopieer het voorbeeldbestand en configureer je databasegegevens:
```bash
cp .env.example .env
php artisan key:generate
```
Pas de database-instellingen aan in je `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=festivo
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Voer migraties en seeders uit (Inclusief Default Admin)
```bash
php artisan migrate:fresh --seed
```

### 5. Start de Development Server
```bash
php artisan serve
```
Open je browser op `http://127.0.0.1:8000` om het project te bekijken! 🎉

---

##  Technische Uitdaging en Slimme Oplossing
- **Het PHP Upload Probleem:** Door strikte Windows OS-rechten op de tijdelijke upload-map (`upload_tmp_dir`) faalden fysieke file uploads. Om de stabiliteit en functionaliteit van de applicatie 100% te garanderen, is er gekozen voor een flexibel URL-systeem (`nullable|string`). De Blade-view controleert automatisch of de invoer een externe link is:
  ```php
  <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" ...>
  ```

---

##  Handige Artisan Commando's
```bash
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan storage:link
```

---

##  Screenshots van de Applicatie


---

## Gebruikte Bronnen en AI Chatlog
- Officiële Laravel Documentatie (https://laravel.com/docs)
- Blade Templating en Eloquent Relationships gidsen
- AI Gemini (chatlog inbegrepen voor debuggen van de URL-fallback logica)
