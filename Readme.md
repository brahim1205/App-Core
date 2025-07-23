# Appcore

**Appcore** est un micro-framework PHP léger et modulaire conçu pour t’aider à démarrer rapidement un projet PHP avec une structure bien définie. Il offre des fonctionnalités de routage, middlewares, gestion des sessions, entités, validation, configuration, et bien plus encore.

## 📦 Installation

Installe le package via [Composer](https://getcomposer.org/):

\`\`\`bash

composer require khalilouh/appcore

\`\`\`

## 🗂 Structure du projet

Voici un aperçu de la structure du framework :

\`\`\`
app/
├── config/              # Fichiers de configuration (env, routes, services)
│   ├── bootstrap.php
│   ├── dependencies.php
│   ├── env.php
│   ├── helpers.php
│   ├── middlewares.php
│   └── service.yaml
├── core/                # Cœur du framework
│   ├── abstract/        # Classes abstraites : Controller, Entity, Repository
│   ├── App.php
│   ├── Database.php
│   ├── Router.php
│   ├── Session.php
│   ├── Validator.php
│   └── middlewares/     # Middlewares personnalisés (ex: Auth)
│       └── Auth.php
├── translate/
│   └── fr/
│       └── error\_fr.php


\`\`\`

## 🚀 Guide de démarrage rapide

### 1. Point d'entrée (\`public/index.php\`)

\`\`\`php

<?php

require __DIR__ . '/../vendor/autoload.php';

use khalilouh\\Appcore\\core\\App;

$app = new App();
$app->run();
\`\`\`

### 2. Déclaration d’une route

\`\`\`php
use khalilouh\\Appcore\\core\\Router;

Router::get('/home', [HomeController::class, 'index']);
\`\`\`

### 3. Exemple de contrôleur

\`\`\`php
namespace App\\Controllers;

use khalilouh\\Appcore\\core\\abstract\\abstractController;

class HomeController extends abstractController
{
    public function index()
    {
        return \$this->render('home', ['message' => 'Bienvenue sur Appcore']);
    }
}
\`\`\`

### 4. Middleware personnalisé

\`\`\`php
namespace khalilouh\\Appcore\\core\\middlewares;

class Auth
{
    public function handle(\$request, \$next)
    {
        // Vérifier l’authentification
        if (!isset(\$_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        return \$next(\$request);
    }
}
\`\`\`

### 5. Entité et dépôt

\`\`\`php
namespace App\\Entities;

use khalilouh\\Appcore\\core\\abstract\\abstractEntity;

class User extends abstractEntity
{
    protected string \$table = 'users';
}
\`\`\`

\`\`\`php
namespace App\\Repositories;

use khalilouh\\Appcore\\core\\abstract\\abstractRepository;

class UserRepository extends abstractRepository
{
    protected string \$entity = User::class;
}
\`\`\`

## ⚙ Configuration

- \`env.php\` : Variables d'environnement (base de données, app locale, etc.)
- \`middlewares.php\` : Liste des middlewares globaux
- \`service.yaml\` : Déclaration de services injectables
- \`dependencies.php\` : Injection de dépendances

## 🌍 Traduction

Les fichiers de traduction (ex. \`error_fr.php\`) permettent de gérer les messages d’erreur localisés selon la langue définie dans l’environnement.

## ✅ Fonctionnalités clés

- ✅ Routage simplifié
- ✅ Système de middlewares
- ✅ MVC avec contrôleurs abstraits
- ✅ ORM léger via entités
- ✅ Validation des entrées
- ✅ Gestion des sessions
- ✅ Configuration via YAML
- ✅ Prise en charge multilingue

## 🧪 Tests

Pour exécuter des tests, il est recommandé d’utiliser PHPUnit. (À configurer selon le besoin)

## 📚 Contributions

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une _issue_ ou une _pull request_.

## 👨‍💻 Auteur

- **Nom :** brahim1205  
- **Email :** sadiocheri11@gmail.com

## 📄 Licence

Ce projet est sous licence **MIT** — vous pouvez l’utiliser librement dans vos projets personnels ou professionnels.

---

Merci d’utiliser **Appcore**. Bon développement ! 🚀
EOF
```

---
`

