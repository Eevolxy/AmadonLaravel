# 🚀 Guide d'installation — Amadon Laravel

Ce guide vous explique **deux manières** de faire tourner le projet en local :

| Méthode | Résumé | Quand l'utiliser |
|---------|--------|-----------------|
| **[Méthode 1 — Laravel Sail + Docker](#méthode-1--laravel-sail--docker-recommandé)** | Environnement Docker complet (PHP, MySQL, Mailpit) | Environnement reproductible, pas besoin d'installer PHP/MySQL sur la machine |
| **[Méthode 2 — Mode natif](#méthode-2--mode-natif-php-artisan-serve--npm-run-dev)** | PHP + MySQL en local, pas de Docker | Installation rapide, idéal pour du dev rapide |

---

## Prérequis communs

- **Git** — pour cloner le projet
- **Node.js ≥ 18** et **npm** — pour compiler les assets front (Vite + Tailwind CSS 4)

---

## Méthode 1 — Laravel Sail + Docker (recommandé)

Laravel Sail fournit un environnement Docker préconfigé avec **PHP 8.5**, **MySQL 8.4** et **Mailpit**.

### 1.1 Prérequis spécifiques

#### a) Installer WSL 2 (Windows Subsystem for Linux)

> ⚠️ **Cette étape est obligatoire sous Windows.** Docker Desktop utilise WSL 2 comme backend.

Ouvrez **PowerShell en tant qu'administrateur** et exécutez :

```powershell
wsl --install
```

Cela installe WSL 2 avec Ubuntu par défaut. **Redémarrez votre PC** quand c'est demandé.

Après le redémarrage, Ubuntu se lance automatiquement et vous demande de créer un **nom d'utilisateur** et un **mot de passe** Linux.

Vérifiez que WSL 2 est bien activé :

```powershell
wsl --list --verbose
```

Vous devez voir votre distribution avec **VERSION 2**. Si ce n'est pas le cas :

```powershell
wsl --set-version Ubuntu 2
```

#### b) Installer Docker Desktop

1. Téléchargez [Docker Desktop pour Windows](https://www.docker.com/products/docker-desktop/).
2. Lors de l'installation, cochez **« Use WSL 2 based engine »**.
3. Lancez Docker Desktop.
4. Allez dans **Settings → Resources → WSL Integration** et activez l'intégration pour votre distribution Ubuntu.
5. Cliquez **Apply & Restart**.

#### c) Vérifier que tout fonctionne

Dans un terminal **Ubuntu (WSL)** :

```bash
docker --version
docker compose version
```

Les deux commandes doivent retourner des numéros de version sans erreur.

---

### 1.2 Cloner le projet dans WSL

> ⚠️ **Important :** Pour de meilleures performances, clonez le projet **dans le système de fichiers Linux** (pas dans `/mnt/c/...`).

Ouvrez un terminal **Ubuntu (WSL)** :

```bash
# Créer un dossier pour vos projets (exemple)
mkdir -p ~/projects && cd ~/projects

# Cloner le dépôt
git clone <URL_DU_DEPOT> AmadonLaravel
cd AmadonLaravel
```

---

### 1.3 Installer les dépendances Composer (sans PHP local)

Sail n'est pas encore disponible car les dépendances ne sont pas installées. On utilise un conteneur Docker temporaire :

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

> 💡 Cette commande télécharge temporairement un conteneur avec PHP + Composer, installe les dépendances, puis se supprime.

---

### 1.4 Configurer l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env
```

Éditez le fichier `.env` pour configurer la **connexion MySQL** (adaptée à Docker) :

```dotenv
APP_NAME=Amadon
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=amadon
DB_USERNAME=sail
DB_PASSWORD=password
```

> 📝 `DB_HOST=mysql` correspond au nom du service dans le `compose.yaml`. Ne mettez **pas** `127.0.0.1` ici.

---

### 1.5 Lancer Sail

```bash
# Démarrer les conteneurs en arrière-plan
./vendor/bin/sail up -d
```

La première exécution prend quelques minutes (construction de l'image Docker).

Vérifiez que tout tourne :

```bash
./vendor/bin/sail ps
```

Vous devez voir 3 conteneurs : `laravel.test`, `mysql`, `mailpit`.

---

### 1.6 Initialiser l'application

```bash
# Générer la clé de l'application
./vendor/bin/sail artisan key:generate

# Exécuter les migrations
./vendor/bin/sail artisan migrate

# (Optionnel) Peupler la base avec des données de test
./vendor/bin/sail artisan db:seed
```

> 📝 Le seeder crée un utilisateur admin (`admin@amadon.fr` / `password`), 10 utilisateurs, 30 articles et des coupons.

---

### 1.7 Installer et compiler les assets front

```bash
# Installer les dépendances npm
./vendor/bin/sail npm install

# Lancer Vite en mode développement (hot reload)
./vendor/bin/sail npm run dev
```

---

### 1.8 Accéder à l'application

| Service | URL |
|---------|-----|
| **Application** | [http://localhost](http://localhost) |
| **Vite (HMR)** | [http://localhost:5173](http://localhost:5173) |
| **Mailpit (emails)** | [http://localhost:8025](http://localhost:8025) |
| **MySQL** | `localhost:3306` (client MySQL) |

---

### 1.9 Commandes Sail utiles

```bash
# Arrêter les conteneurs
./vendor/bin/sail down

# Voir les logs en temps réel
./vendor/bin/sail logs -f

# Ouvrir un shell dans le conteneur
./vendor/bin/sail shell

# Lancer les tests
./vendor/bin/sail artisan test

# Exécuter Tinker (REPL PHP)
./vendor/bin/sail tinker

# Reconstruire les images (après modif du Dockerfile)
./vendor/bin/sail build --no-cache
```

### 1.10 Alias pratique (optionnel)

Pour éviter de taper `./vendor/bin/sail` à chaque fois, ajoutez un alias dans votre `~/.bashrc` ou `~/.zshrc` :

```bash
alias sail='./vendor/bin/sail'
```

Rechargez votre shell :

```bash
source ~/.bashrc
```

Ensuite, utilisez simplement `sail up -d`, `sail artisan migrate`, etc.

---

### 1.11 Résolution de problèmes courants (Sail/Docker)

<details>
<summary><strong>❌ Le port 80 est déjà utilisé</strong></summary>

Modifiez le port dans votre `.env` :

```dotenv
APP_PORT=8080
```

L'application sera accessible sur [http://localhost:8080](http://localhost:8080).

</details>

<details>
<summary><strong>❌ Le port 3306 est déjà utilisé (MySQL local installé)</strong></summary>

```dotenv
FORWARD_DB_PORT=33060
```

Connectez-vous via le port `33060` depuis votre client MySQL local.

</details>

<details>
<summary><strong>❌ Permission denied sur les fichiers</strong></summary>

```bash
# Dans le conteneur
./vendor/bin/sail shell
chmod -R 775 storage bootstrap/cache
chown -R sail:sail storage bootstrap/cache
```

</details>

<details>
<summary><strong>❌ Les performances sont lentes sous Windows/WSL</strong></summary>

- Assurez-vous que le projet est dans le **système de fichiers Linux** (`~/projects/...`) et **pas** dans `/mnt/c/...`.
- Dans Docker Desktop → Settings → Resources → WSL Integration, vérifiez que votre distribution est bien activée.

</details>

<details>
<summary><strong>❌ Vite HMR ne fonctionne pas</strong></summary>

Vérifiez que le port 5173 est bien exposé dans `compose.yaml` (c'est déjà le cas par défaut). Si vous avez changé le port :

```dotenv
VITE_PORT=5174
```

</details>

---
---

## Méthode 2 — Mode natif (`php artisan serve` + `npm run dev`)

Cette méthode ne nécessite **pas Docker**. Elle utilise le serveur intégré de PHP et une base **MySQL** locale.

### 2.1 Prérequis spécifiques

| Outil | Version minimale | Vérification |
|-------|-----------------|---------------|
| **PHP** | ≥ 8.2 | `php -v` |
| **Composer** | ≥ 2.x | `composer -V` |
| **MySQL** | ≥ 8.0 | `mysql --version` |
| **Node.js** | ≥ 18 | `node -v` |
| **npm** | ≥ 9 | `npm -v` |

> 💡 **Sous Windows**, [Laragon](https://laragon.org/) ou [XAMPP](https://www.apachefriends.org/) fournissent PHP et MySQL ensemble.

#### Extensions PHP requises

Laravel 12 nécessite les extensions suivantes (la plupart sont activées par défaut) :

- `pdo_mysql` (pour MySQL)
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `bcmath`
- `fileinfo`
- `curl`

Pour vérifier les extensions installées :

```bash
php -m
```

> 💡 Si vous utilisez Laragon ou XAMPP, la plupart des extensions sont déjà activées. Sinon, décommentez les lignes correspondantes dans votre `php.ini`.

---

### 2.2 Cloner le projet

```bash
git clone <URL_DU_DEPOT> AmadonLaravel
cd AmadonLaravel
```

---

### 2.3 Installer les dépendances

```bash
# Dépendances PHP
composer install

# Dépendances front
npm install
```

---

### 2.4 Créer la base de données MySQL

Connectez-vous à MySQL et créez la base de données :

```bash
mysql -u root -p
```

```sql
CREATE DATABASE amadon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

> 💡 Si votre utilisateur `root` n'a pas de mot de passe (cas par défaut avec Laragon/XAMPP), utilisez simplement `mysql -u root`.

---

### 2.5 Configurer l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env
```

Éditez le fichier `.env` pour configurer la **connexion MySQL** :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amadon
DB_USERNAME=root
DB_PASSWORD=
```

> 📝 Adaptez `DB_USERNAME` et `DB_PASSWORD` selon votre configuration MySQL locale.

Générez la clé d'application :

```bash
php artisan key:generate
```

---

### 2.6 Exécuter les migrations et les seeders

```bash
# Créer les tables
php artisan migrate

# (Optionnel) Peupler la base avec des données de test
php artisan db:seed
```

> 📝 Le seeder crée :
> - 1 admin : `admin@amadon.fr` / `password`
> - 10 utilisateurs de test
> - 30 articles
> - Des coupons de réduction

---

### 2.7 Lancer le projet

#### Option A — Tout lancer d'un coup (recommandé)

Le projet inclut un script Composer qui lance **tous les services** simultanément :

```bash
composer dev
```

Cela démarre en parallèle :
- 🌐 **Serveur PHP** (`php artisan serve`) → [http://localhost:8000](http://localhost:8000)
- 📋 **Queue worker** (`php artisan queue:listen`)
- 📝 **Logs en temps réel** (`php artisan pail`)
- ⚡ **Vite** (`npm run dev`) → Hot reload des assets

> 💡 Appuyez sur `Ctrl+C` pour tout arrêter d'un coup.

#### Option B — Lancer chaque service séparément

Ouvrez **deux terminaux** :

**Terminal 1 — Serveur PHP :**

```bash
php artisan serve
```

**Terminal 2 — Vite (assets front) :**

```bash
npm run dev
```

---

### 2.8 Accéder à l'application

| Service | URL |
|---------|-----|
| **Application** | [http://localhost:8000](http://localhost:8000) |
| **Vite (HMR)** | [http://localhost:5173](http://localhost:5173) |

> ⚠️ En mode natif, **Mailpit n'est pas disponible**. Les emails sont écrits dans les logs (`MAIL_MAILER=log`). Consultez-les dans `storage/logs/laravel.log` ou via `php artisan pail`.

---

### 2.9 Résolution de problèmes courants (mode natif)

<details>
<summary><strong>❌ "Could not find driver" (MySQL)</strong></summary>

L'extension `pdo_mysql` n'est pas activée. Ouvrez votre `php.ini` :

```bash
php --ini   # pour trouver le chemin du php.ini
```

Décommentez la ligne :

```ini
extension=pdo_mysql
```

Redémarrez votre serveur.

</details>

<details>
<summary><strong>❌ "Access denied for user 'root'@'localhost'"</strong></summary>

Vérifiez les identifiants dans votre `.env` :

```dotenv
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

Assurez-vous que l'utilisateur MySQL a les droits sur la base `amadon`.

</details>

<details>
<summary><strong>❌ "Unknown database 'amadon'"</strong></summary>

La base n'a pas été créée. Connectez-vous à MySQL et exécutez :

```sql
CREATE DATABASE amadon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

</details>

<details>
<summary><strong>❌ Le port 8000 est déjà utilisé</strong></summary>

```bash
php artisan serve --port=8080
```

</details>

<details>
<summary><strong>❌ Les styles ne se chargent pas</strong></summary>

Assurez-vous que Vite tourne dans un terminal séparé (`npm run dev`). Si le problème persiste :

```bash
npm run build
```

Cela compile les assets en production (pas de hot reload).

</details>

<details>
<summary><strong>❌ "npm ERR! concurrently" lors de `composer dev`</strong></summary>

Le package `concurrently` n'est pas installé. Lancez :

```bash
npm install
```

Puis relancez `composer dev`.

</details>

---
---

## Résumé comparatif

| | Sail + Docker | Mode natif |
|---|---|---|
| **Base de données** | MySQL 8.4 (Docker) | MySQL (local) |
| **Serveur web** | Nginx (via Sail) sur le port `80` | Serveur PHP intégré sur le port `8000` |
| **Emails** | Mailpit (interface web sur `8025`) | Logs (`storage/logs/laravel.log`) |
| **Prérequis machine** | Docker Desktop + WSL 2 | PHP ≥ 8.2, Composer, MySQL ≥ 8.0, Node.js |
| **Performance** | Dépend de la config Docker/WSL | Natif, très rapide |
| **Commande de lancement** | `sail up -d` + `sail npm run dev` | `composer dev` |
| **Idéal pour** | Environnement reproductible, équipe | Dev solo rapide |

---

## Commandes utiles (les deux méthodes)

```bash
# Vider le cache
php artisan cache:clear        # ou sail artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Relancer les migrations (⚠️ supprime les données)
php artisan migrate:fresh --seed

# Lancer les tests
php artisan test

# Linter le code PHP
./vendor/bin/pint

# Build production des assets
npm run build
```
