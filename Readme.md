# ⚙️ Appcore

**Appcore** est un micro-framework PHP léger, modulaire et extensible conçu pour t’aider à démarrer rapidement un projet PHP avec une architecture propre. Il intègre les concepts essentiels : routage, middlewares, entités, contrôleurs, validation, configuration, traduction et gestion des sessions.

---

## 🚀 Installation

Installe le package via [Composer](https://getcomposer.org/):

```bash
composer require khalilouh/appcore


 Arborescence du projet
 app/
├── config/              # Configuration globale
│   ├── bootstrap.php
│   ├── dependencies.php
│   ├── env.php
│   ├── helpers.php
│   ├── middlewares.php
│   └── service.yaml
├── core/                # Cœur du framework
│   ├── App.php
│   ├── Router.php
│   ├── Session.php
│   ├── Database.php
│   ├── Validator.php
│   ├── abstract/        # Classes abstraites : Controller, Entity, Repository
│   └── middlewares/     # Middlewares (ex: Auth)
├── translate/
│   └── fr/
│       └── error_fr.php


Utilisation rapide
1. Démarrage de l'application

// public/index.php
require __DIR__ . '/../vendor/autoload.php';

use khalilouh\Appcore\core\App;

$app = new App();
$app->run();


2. Définir une route

use khalilouh\Appcore\core\Router;

Router::get('/home', [HomeController::class, 'index']);

⚙️ Configuration
| Fichier            |Rôle          
| ------------------ | --------------------------------------------------------- |
| `env.php`          | Variables d’environnement (base de données, locale, etc.) |
| `bootstrap.php`    | Initialisation globale de l’application                   |
| `dependencies.php` | Dépendances injectées dans les services                   |
| `middlewares.php`  | Liste des middlewares globaux à appliquer                 |
| `service.yaml`     | Déclaration des services à injecter automatiquement       |



👤 Auteur
Nom : brahim1205

Email : sadiocheri11@gmail.com