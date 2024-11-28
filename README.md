# SGT

Ce projet consiste est une application web de gestion des tâches (SGT) simple et fonctionnelle, permettant aux utilisateurs de créer, organiser et suivre leurs tâches personnelles. L'application intègre des fonctionnalités telles que la gestion des utilisateurs, l'organisation par priorités et échéances, des rappels par email, ainsi que la gestion des commentaires. 

Ce projet utilise **CodeIgniter 4** pour gérer des tâches web de base, y compris l'interaction avec une base de données, des formulaires, et un système de routage. Ce modèle peut être utilisé comme point de départ pour vos projets.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

- **Linux**
- **PHP 8.1 ou supérieur**
- **Base de données PostgreSQL**

## Installation

Suivez les étapes ci-dessous pour installer et configurer le projet localement.

### 1. Clonez le dépôt

Clonez ce projet dans le répertoire de votre choix grâce à la commande :

```bash
git clone git@github.com:Biyiv/SGT.git
```

### 2. Ajouter un fichier pour se connecter à la Base de Données

Dans le répertoire ``` app/Config/ ``` ajouter un fichier ``` Database.php ``` qui à la structure suivante : 
```php
<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost', 
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
```
Modifiez désormais le ``` $default ``` afin d'avoir vos informations de connexion à la base de données.

### 3. Créer la structure de la base de données

Pour créer la base de données, mettez vous à la racine du répertoire du projet et écrivez la commande :
```bash
php spark migrate
```

### 4. Initialiser la base de données

Pour insérer des données, mettez vous à la racine du répertoire du projet et écrivez les commandes suivantes dans l'ordre:
```bash
php spark db:seed UtilisateurSeeder
```
puis : 
```bash
php spark db:seed TacheSeeder
```
enfin : 
```bash
php spark db:seed CommentaireSeeder
```

## Lancement de l'application

Pour lancer le serveur, mettez vous à la racine du répertoire du projet et écrivez la commande :
```bash
php spark serve
```
