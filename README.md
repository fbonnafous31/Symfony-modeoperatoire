# Mode opératoire : Démarrer avec Symfony

J’ai récemment réalisé une formation en ligne sur le Framework Symfony, autour des langages PHP et Twig. Excellente et très complète créée par Lior Chamla.

Formation de grande qualité que je recommande volontiers à qui souhaite découvrir Symfony.

[Symfony 5 : Le guide complet (web-develop.me)](https://learn.web-develop.me/view/courses/symfony-5-le-guide-complet-debutants-et-intermediaires)

Afin de consolider et d’ancrer les compétences acquises par cette formation, je souhaite réaliser un projet et un document de synthèse permettant de faire le tour de toutes les pratiques et tous les enseignements de la formation. 

Je me suis également demandé s’il était possible de créer une application assez rapidement sans maîtriser le langage de programmation que je n’utilise pas dans mon quotidien professionnel, mais en ayant appris de bonnes pratiques et de bons réflexes par le biais d’une bonne formation. 

S’il était possible de conserver les acquis de la formation, si je ne devais m’y remettre que dans plusieurs mois. Est-ce que je serai capable avec un support de retrouver très rapidement des marques dans un domaine qui n’est pas celui que je maîtrise. 

Je me suis aussi intéressé aux autres formations que celles proposés par Lior, en regardant ce qui existe. Il existe des formations à tous les prix, avec un formateur qui sont généralement destinées aux entreprises, ou en ligne comme celle que j’ai suivi qui sont plus adaptés à mon budget :D.

Pour avoir essayé les deux types de formations je me suis demandé si l’une était meilleure que l’autre, et bizarrement j’aurai envie de dire que ce n’est pas la plus chère qui est forcément la meilleure et pour plusieurs raisons :

- Le fait de payer sa formation et ne pas se la faire financer marque une réelle envie d’apprendre sur un sujet particulier. Si je n’ai pas envie de claquer mon argent, je suis normalement motivé à m’investir dans ce que j’ai acheté.

Là où lorsque mon entreprise me paye une formation ce n’est pas forcément mon choix, et parfois je ne vais jamais appliquer ce que j’ai appris, donc l’oublier mais bon ce n’est pas moi qui gère le budget formation, je suis plus détaché. 

- Le fait que le cours soit en ligne m’oblige à m’investir. Si je fais une erreur, je dois trouver comment la corriger soit en revoyant le cours, soit en recherchant une solution. Sinon je suis bloqué et je ne peux plus avancer dans la formation, ce qui serai dommage. Finalement, l’erreur est source d’apprentissage. 

Là où lors d’une formation en présentiel, je n’ai qu’à attendre que le formateur vienne me débloquer sans que je n’aie besoin de faire l’effort de chercher. 

- Le niveau du formateur n’est pas aligné sur son prix. Une formation en ligne peut être de qualité et peu chère, là où en présentiel le message du formateur peut ne pas passer (ou vice versa bien évidemment). Le prix n’est pas nécessairement gage de qualité. 

Au final, la bonne formation est celle qui permet de comprendre le message transmis, à chacun sa préférence et son rythme.

L’idée de ce support est de donner les éléments de base et les étapes à la construction d’un projet, les outils et les composants nécessaires à chaque étape, de créer le mode opératoire me permettant de démarrer rapidement sur n’importe quel projet. 

## Voici ma recette d’un développement avec Symfony étape par étape.

Je souhaite créer un projet de gestion de recettes de cuisine avec une architecture permettant de gérer les recettes de cuisines, les ingrédients et ustensiles nécessaires à la réalisation de la recette, ainsi que les différentes étapes de fabrication. 

Le projet devrait permettre de consulter une liste de recette, créer ou modifier une recette, administrer la liste des ingrédients et ustensiles nécessaire à la réalisation d’une recette. 

Le schéma de base de données permet d’illustrer l’ensemble des cas existant au niveau de relations, à savoir les relations OneToMany et ManyToMany. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.001.png)

Ce projet pourrait à terme également évoluer en ajoutant le chargement de photos de la recette, un système de notation de recette ou la possibilité de laisser des commentaires. 

L’idée de base est d’avoir un socle minimum de connaissance permettant la gestion du plus grand nombre de cas possibles. 
**

## Étape 1 - Les outils nécessaires à la réalisation du projet

**Éditeur de texte VS Code**

**Extensions à installer :**

- Intelephense
- Namespace Resolver
- Twig Langage2
- MySQL
- Markdown Preview Enhanced

**Paramétrage de VS Code**

- Désactiver PHP>Suggest:Basic

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.002.png)

- Activer le formatage lors de la sauvegarde

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.003.png)

- Définir le langage Twig

**Serveur Apache**

**PHP** (version minimale PHP7)  

Connaitre sa version en ligne de commande : php -v

**Base de données MySQL**

**Composer** (outil de gestionnaires des dépendances)

Connaitre sa version en ligne de commande : composer -V

**Git** (outil de versionnage du code source)

Connaitre sa version en ligne de commande : git --version


## Étape 2 - Initialisation du projet

**Initialisation du projet**

```
composer create-project symfony/skeleton project_name
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.004.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.005.png)

**Création d’un dépôt Git**

```
git init
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.006.png)

**Lancer le serveur**

```
symfony serve
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.007.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.008.png)
## Étape 3 - Les routes 

Lorsque l’application reçoit une demande, elle appelle une action de contrôleur pour générer la réponse. La configuration du routage définit l’action à exécuter.

**Utilisation de Symfony Flex pour charger les services d’annotations**

[Using Symfony Flex to Manage Symfony Applications (Symfony 3.4 Docs)](https://symfony.com/doc/3.4/setup/flex.html)

Symfony Flex est une fonction permettant d’installer et gérer les applications Symfony. Il permet d’automatiser les tâches les plus communes et notamment la commande de chargement des services en récupérant les services correspondant à partir de mots clés (mailer, annotations, …) sans avoir à connaître le véritable nom des services. 

Par exemple lorsque je demande à composer de charger les services pour la gestion des annotations, Symfony Flex va installer automatiquement les bons services par défaut (doctrine/annotations, doctrine/deprecations, doctrine/lexer et sensio/framework-extra-bundle).

**Attention** à bien être positionné dans le répertoire du projet  (sinon la commande de chargement ne fonctionne pas).

```
composer require annotations
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.009.png)

**Test du système d’annotations**

Nécessite l’utilisation de la bibliothèque de Route du service d’annotations de Symfony

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.010.png)

## Étape 4 - Les objets de la base de données 

Doctrine est un ORM qui permet de faire le lien entre les objets et la base de données. Il s’agit de l’ORM par défaut du Framework Symfony.

**Création de la base de données**

```
composer require doctrine
```

**Installation du système de gestion des objets de base de données Symfony**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.011.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.012.png)

Symfony propose de mettre à jour le fichier d’environnement dans lequel je vais configurer ma base de données. Dans mon cas j’utilise une base de données MySQL pour l’environnement de développement. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.013.png)

**Création de la base de données pour le projet**

```
php bin/console doctrine:database:create
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.014.png)

**Connexion à la base de données via l’extension MySQL de VS Code**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.015.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.016.png)

**

**Accès à la base de données via PHPMyAdmin**

PHPMyAdmin propose des options plus avancées que l’extension MySQL de VS Code. Il peut être intéressant d’y avoir accès.

Personnellement j’utilise l’extension MySQL de VS Code pour la visualisation de données (SELECT) et leurs manipulations de base (INSERT, UPDATE et DELETE). Et PHPMyAdmin pour des fonctionnalités plus avancées, telles que l’administration, la gestion d’import ou d’export. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.017.png)**

**Création d’un objet simple**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.018.png)

**Installation des composant permettant la gestion des objets (maker)**

Maker va me permettre de créer mes entités en ligne de commande

```
composer require maker
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.019.png)

**Liste des commandes disponibles en lignes de commandes via maker**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.020.png)


**Création de l’entité recette et de ses attributs**

```
php bin/console make:entity entity_name
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.021.png)![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.022.png)

Symfony crée une entité Recette ainsi qu’un Repository

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.023.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.024.png)

Il faut ensuite réaliser une migration qui va générer un script contenant les instructions SQL nécessaires à la création de l’objet dans la base de données.

```
php bin/console make:migration
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.025.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.026.png)

Une fois le script de migration en base, il reste à l’exécuter. 

L’exécution du script de migration va créer l’entité dans la base de données. 

```
php bin/console doctrine:migrations:migrate
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.027.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.028.png)

Il reste à créer les objets ingrédients et ustensiles qui vont stocker les éléments nécessaires à nos recettes de cuisine.

Créer les entités, créer les scripts de migration et exécuter les scripts de migration pour mettre à jour notre base de données.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.029.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.030.png)
## Étape 5 - Alimenter la base de données (les fixtures)

Les fixtures sont des jeux de données. Symfony permet d’alimenter la base de données via l’utilisation de jeux de données. 

L’installation du gestionnaire de fixtures va créer un répertoire de gestion de fixture dans lequel il va être possible de développer un script (AppFixtures.php) permettant de mettre à jour la base de données.

**Installation du système de gestion des fixtures** 

```
composer require orm-fixtures
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.031.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.032.png)







Afin d’alimenter la base de données j’ai créé deux jeux de données au format CSV qui contiennent une liste d’ingrédients et une liste d’ustensiles que je vais vouloir importer dans la base de données.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.033.png)

Une fois le script crééil suffit de l’exécuter en ligne de commande. 

```
php bin/console doctrine:fixtures:load
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.034.png)

L’exécution du script permet d’alimenter les tables de la base de données. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.035.png)**
## Étape 6 - Le langage d’affichage (Twig)

Twig est un moteur de template pour PHP utilisé avec Symfony.

**Installation du moteur de template Twig**

```
composer require twig
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.036.png)

L’installation met à jour les fichiers de configuration et crée les répertoires dédiés aux templates.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.037.png) 

Création de la page d’accueil

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.038.png)

**Création du contrôleur de la page d’accueil**

La classe HomeController hérite d’une classe AbstractController qui permet d’hériter de fonctionnalités avancées qui rendent l’écriture du code plus rapide. 

Dans cet exemple l’ AbstractController permet d’utiliser une fonction render qui redirige sur la page home.html.twig.

[symfony/AbstractController.php at 6.2 · symfony/symfony · GitHub](https://github.com/symfony/symfony/blob/6.2/src/Symfony/Bundle/FrameworkBundle/Controller/AbstractController.php)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.039.png)

**Création du template**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.040.png)


## Étape 7 - Premiers formulaires (mise en place de formulaires simples avec CRUD)

CRUD est l’acronyme de Create, Read, Update, Delete. 

Symfony dispose d’une commande permettant la gestion du CRUD. 

La commande de génération du CRUD permet de créer :

- le contrôleur pour l'entité avec des fonctions permettant
  - la visualisation de la liste des ingrédients
  - la visualisation des informations d’un ingrédient
  - la création d'un nouvel ingrédient
  - la mise à jour d’un ingrédient
  - la suppression d’un ingrédient
- un formulaire par défaut
- des templates permettant de visualiser, créer ou modifier les informations

**Installation du composant de sécurité de validation des formulaires csrf**

```
composer require form validator security-csrf
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.041.png)

**Création des composant à partir de la commande**

```
php bin/console make:crud
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.042.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.043.png)



**

**Contenu du contrôleur** 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.044.png)

**Exemples de rendu (liste et formulaire de modification d’un ingrédient)**

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.045.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.046.png)** 


## Étape 8 - Les objets de la base de données de type 1-n 

Un objet de type 1-n est un objet qui dispose d’une relation avec un autre objet.

- Une recette de cuisine peut être composé de plusieurs étapes pour sa réalisation (n)
- Une étape est propre à une seule recette de cuisine (1)
- Dans ce genre de relation l’identifiant de la recette devient un élément clé (clé secondaire) de l’entité étape.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.047.png)



Création de l’entité Étape

```
php bin/console make:entity entity_name
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.048.png)

Création de la relation avec l’entité Recette

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.049.png)


Symfony crée de nouvelles fonctions au niveau de l’entité recette pour permettre de faciliter la gestion des étapes. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.050.png)

Reste à créer le script de migration et à l’exécuter pour retrouver la nouvelle entité et la relation au niveau de la base de données.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.051.png)

Et à l’exécuter

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.052.png)

Au niveau de la base de données

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.053.png)

## Bonus 1 - Le debugger de Symfony

Avant de continuer le développement de l’application, on peut installer un composant assez sympa de Symfony qui communique de nombreuses informations sur le traitement des requêtes, les performances, les accès à la base de données et plein d’autres informations, le debugger.

```
composer require debug
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.054.png)

Visualisation du nom de la route, du contrôleur et du statut.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.055.png)

Visualisation des informations contenues dans la requête, la réponse, les performances, les logs, les formulaires, la gestion des événements, du routage, de Twig, éléments de débogage, de la base de données, éléments de configurations, en gros tout :D

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.056.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.057.png)

## Étape 9 - Mise en place d’un service d’authentification

Afin de savoir sur quelle partie du site les utilisateurs pourront accéder et quelles actions seront autorisées en fonction de leurs rôles, nous allons créer un système d’authentification avec un rôle d’administrateur et le rôle d’utilisateur connecté et un rôle de visiteur.

Le visiteur pourra visualiser les recettes.

L’utilisateur connecté pourra créer des recettes et les visualiser.

L’administrateur pourra administrer les ingrédients et ustensiles, créer des recettes et les visualiser.

Il faut d’abord installer le service sécurité de Symfony.

```
composer require security
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.058.png)

Une fois installé nous allons créer une entité pour gérer nos utilisateurs. Il s’agit d’une entité un peu particulière créée à partir de la commande make:user (au lieu de la commande make :entity) qui implémente l’interface UserInterface.

```
php bin/console make:user User
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.059.png)


La commande va modifier le fichier de sécurité yaml pour indiquer quelle classe va gérer les utilisateurs et quelle propriété va permettre leur authentification.  

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.060.png)

La commande va créer une classe permettant de gérer nos utilisateurs.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.061.png)

On effectue la migration qui va créer le fichier de migration contenant les commande SQL permettant la mise à jour de notre base de données avec la création de notre entité stockant les utilisateurs. 

```
php bin/console make:migration
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.062.png)

Et on lance le traitement.

```
php bon/console doctrine:migrations:migrate
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.063.png)

Notre entité utilisateur est désormais créée au niveau de la base de données

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.064.png)

Reste à créer un jeu de données d’utilisateurs avec un mot de passe encodé. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.065.png)


\* On lance la création du jeu de données.

```
php bin/console doctrine:fixtures:load
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.066.png)

Nos deux utilisateurs (utilisateur connecté et administrateur) existent maintenant dans notre base de données. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.067.png)


Reste à créer le système d’authentification. 

![Aperçu de l’image](Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.068.png)

L’utilisateur peut se connecter grâce au formulaire d’authentification, à l’aide de son courriel

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.069.png)

Dernier détail, il reste à rediriger l’utilisateur une fois connecté. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.070.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.071.png)

Cette fois l’administrateur est bien connecté et nous l’avons redirigé vers la page d’accueil.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.072.png)


## Étape 10 - La gestion des rôles

Symfony offre la possibilité de permettre l’accès aux fonctions, à une partie du site ou à un rendu d’une page en fonction des rôles défini. 

Dans le cas de mon application, je gère trois rôles : administrateur, utilisateur connecté et visiteur. 

**Gestion des rôles au niveau de Twig**

Les rôles peuvent être gérés au niveau du rendu de la page grâce aux fonctions de Twig.

On peut masquer la fonction d’édition d’un ingrédient si l’on n’a pas les droits d’administration en conditionnant l’accès à l’administrateur (is\_granted) ou à l’utilisateur connecté (app.user).

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.073.png)

En mode administrateur

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.074.png)

En mode utilisateur connecté ou visiteur

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.075.png)

**Gestion des rôles au niveau du contrôleur**

On peut restreindre les droits d’une fonction particulière à un rôle.

L’utilisateur qui essaiera d’accéder à la fonction pour définir un nouveau produit directement en modifiant l’URL ne pourra y accéder que s’il dispose un rôle d’administrateur. Par défaut Symfony renvoi l’utilisateur à la page d’identification si l’utilisateur n’a pas le rôle suffisant. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.076.png)

**Gestion des rôles au niveau de la configuration de la sécurité**

Il est également possible au niveau du fichier de configuration de réserver une partie du site à un rôle particulier. On pourrait envisager que les URL commençant par /admin soient dédiées à l’administration et accessible uniquement aux utilisateurs ayant le rôle d’administrateur. 

La configuration se fait alors au niveau du fichier de sécurité (security.yaml).

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.077.png)

Par défaut un message d’erreur indique que l’accès n’est pas autorisé si un utilisateur autre qu’un administrateur essaye d’accéder à la ressource.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.078.png)


## Étape 11 - Les objets de la base de données de type ManyToMany

Un objet de type ManyToMany est un objet qui dispose d’une relation avec un autre objet de sorte que :

- Une recette de cuisine peut être composé de plusieurs ingrédients pour sa réalisation (Many)
- Un ingrédient peut composer plusieurs recettes de cuisine (Many)
- Dans ce genre de relation, on crée une entité entre les entités ingrédient et recette qui va gérer la relation et permettre de stocker des attributs propres à la relation (par exemple la quantité d’un ingrédient pour la recette et son unité, ma recette de crêpe est composée de 300 grammes de sucre).

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.079.png)

Symfony offre deux possibilités pour gérer ce type de relation :

- L’utilisation de la relation ManyToMany (qui ne permet pas de gérer les attributs et que je n’utiliserai pas dans ce support)
- La création d’une nouvelle entité qui va permettre de gérer des attributs

Dans mon exemple, il est nécessaire de créer une nouvelle relation du fait que je souhaite gérer des attributs dans ma relation. 

**Création de l’entité gérant la relation entre les ingrédients et la recette**

La simulation du ManyToMany se fait par la création de ManyToOne sur les deux identifiants qui seront la clé de la nouvelle entité.

```
php bin/console make:entity entity_name
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.080.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.081.png)

Création des attributs quantité et unité

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.082.png)


Génération de script de migration 

```
php bin/console make:migration
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.083.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.084.png)

Mise à jour de la base de données

```
php bin/console doctrine:migrations:migrate
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.085.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.086.png)

## Bonus 2 - Les messages Flash

L’abstract contrôleur permet la création et la gestion de messages flash, messages que nous pourrons utiliser pour informer l’utilisateur de certaines actions lors du traitement de formulaires. 

La création de ces messages se fait au niveau du contrôleur. Nous allons ajouter un message pour indiquer que la mise à jour de la recette a bien été prise en compte. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.087.png)

Au niveau de l’affichage les messages sont stockés dans une variable app.flashes. Les messages sont stockés en mémoire jusqu’à être affichés. 

Modification du programme base.html.twig dont hérite tous mes fichiers Twig pour afficher les messages sur n’importe quelle partie du site. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.088.png)

Résultat de l’affichage d’un message

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.089.png)
## Étape 12 - Les formulaires simples

La gestion des formulaires nécessite la mise à jour du composant.

```
composer require form
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.090.png)

Au niveau du répertoire de gestion des formulaires, on définit les propriétés des champs du formulaire.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.091.png)

Au niveau du contrôleur nous créons une fonction que permet :

- D’afficher le formulaire
- De traiter la soumission du formulaire

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.092.png)



Affichage au niveau de Twig, les instructions form\_start, form\_errors, form\_row, form\_widget et form\_end permettent de décomposer le formulaire.

[Twig Template Form Function and Variable Reference (Symfony 2.0 Docs)](https://symfony.com/doc/2.0/reference/forms/twig_reference.html)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.093.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.094.png)
## Bonus 3 - Amélioration du visuel avec Bootstrap

Définition d’un thème au niveau du fichier de configuration 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.095.png)

Chargement des feuilles de style dans le fichier de base de l’ensemble des pages du site

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.096.png)


## Étape 12 – Des formulaires un peu plus complexes (la relation OneToMany)

Chaque recette est généralement constituée de plusieurs étapes, aussi nous allons créer un formulaire avec la possibilité d’ajouter dynamiquement le nombre d’étapes voulues. 

Pour cela, j’ai suivi un petit tutoriel de Symfony qui explique comment faire. Pour ajouter un peu de dynamisme à la création des étapes, il faudra ajouter au PHP, des scripts JS faisant appel à JQuery. 

[How to Embed Forms (Symfony Docs)](https://symfony.com/doc/current/form/embedded.html)

Création d’un formulaire pour l’affichage des étapes

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.097.png)

Modification du formulaire de recette pour intégrer les étapes

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.098.png)

Au niveau du formulaire de création Twig, ajout des étapes de la recette

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.099.png)

Pour rendre le formulaire dynamique nous avons besoin d’utiliser la bibliothèque de fonctions JQuery que nous déclarons dans le formulaire de base, ainsi qu’un script JS que nous allons écrire permettant d’ajouter des éléments à une collection (les étapes de notre recette).

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.100.png)

Au niveau de notre entité, il faut ajouter une fonction \_\_tostring.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.101.png)

Et indiquer que la relation avec l’entité étape persiste. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.102.png)



Le script JS permet d’ajouter ou supprimer une étape à la recette

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.103.png)


Au niveau du contrôleur on rajoute la relation entre les étapes et la recette, en rattachant les étapes au moment de la validation du formulaire. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.104.png)


A l’exécution le navigateur permet de saisir une recette, d’ajouter ou supprimer des étapes, et d’enregistrer le résultat dans la base de données. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.105.png)

Résultat du traitement au niveau de la base de données

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.106.png)![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.107.png)


## Étape 13 - Des formulaires un peu plus complexes (la relation ManyToMany)

Chaque recette est composée d’ingrédients et chaque ingrédient peut composer plusieurs recettes. Ces ingrédients sont stockés dans une entité intermédiaire qui fait la relation entre Ingrédient et Recette.

Nous allons créer un formulaire qui contient les informations de la relation intermédiaire : l’ingrédient qui compose la recette, sa quantité et son unité. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.108.png)

Nous ajoutons cette collection à notre formulaire de recette. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.109.png)

Au niveau du contrôleur, il reste à ajouter les ingrédients à la recette. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.110.png)

Au niveau du visuel nous réutilisons le script JS pour prendre en compte l’ajout d’ingrédients à notre recette. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.112.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.114.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.116.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.118.png)

## Étape 14 - Améliorer encore notre application

Il s’agit d’une rapide introduction à Symfony sur un exemple assez simple de mise en place de composants.

De nombreux points sont à terminer (formulaires d’édition, de suppression) ou peuvent être améliorés aussi bien au niveau visuel, qu’au niveau des fonctionnalité. 

On pourrait imaginer gérer des sous catégories d’ingrédients, afficher une image pour chaque ingrédient ou ustensile. 

Améliorer la gestion des droits, la navigation, l’expérience utilisateur, le design, un système de notation des recettes, on peut imaginer plein de choses :D

L’idée de ce développement était surtout d’avoir un guide pour démarrer facilement un projet avec Symfony. 

## Bonus 4 - Le composant de gestion de mail

La première chose à faire pour pouvoir générer des mails est d’installer les composants pour l’utiliser. 

```
composer require mailer
```

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.120.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.121.png)


J’ai repris l’application mailtrap.io pour faire mes tests, comme proposé par Lior dans sa formation. Assez pratique car cela demande peu de configuration. 

Juste mettre à jour le MAILER\_DNS au niveau du fichier d’environnement.

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.122.png)

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.123.png)

Au niveau du contrôleur de recette, charger la mailer interface au niveau du constructeur

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.124.png)

Définir un mail après la création d’une nouvelle recette, et l’envoyer.
## ![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.125.png)
##

Définir un template pour le corps du mail
## ![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.126.png)


Il n’y a plus qu’à créer une nouvelle recette et tester que le mail est correctement généré.

## ![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.127.png)

## Bonus 5 - le composant EventDispatcher 

Le composant EventDispatcher fournit des outils que permettent aux composants de l’application de communiquer entre eux en distribuant des événements et en les écoutants. 

L’EventDispatcher va m’amener à voir les deux premier chapitres SOLID dans cette partie. 

Un super article sur ce sujet ici [SOLID en informatique : 5 principes (avec exemples) – Alex so yes](https://alexsoyes.com/solid/)

Le premier est la responsabilité unique qui dit qu’une classe ne doit avoir qu’une seule responsabilité. 

Pour la mettre en œuvre je vais extraire la fonction de création de ma recette dans une classe qui permettra la fabrication des recettes et qui aura pour seule responsabilité de gérer la création d’une recette de cuisine.

Le deuxième est celui d’entité ouverte et fermée, à savoir que les entités doivent être ouvertes à l’extension et fermées à la modification. 

C’est là que l’on va se servir de l’EventDispatcher qui va permettre de gérer des événements à l’extérieur de la fabrique de recette. 

Je vais ajouter un événement à la suite de la validation de la recette, et lorsque j’aurai besoin d’ajouter une action après la validation de ma recette (comme informer l’administrateur du site qu’une nouvelle recette a été créée), je ne modifierai plus ma fabrique de recette (fermée à la modification), mais je modifierai l’événement déclenché à la suite de l’insertion de la recette dans la base de données (ouvert à l’extension).

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.128.png)

Au niveau du code de la fabrique de recette, je supprime la création du mail qui n’est pas propre à la création de ma recette, en le remplaçant pas un écouteur d’événement. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.129.png)

Et créer un événement qui sera à l’écoute de la réussite de la création de la recette dans la base de données. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.130.png)

Le succès de l’enregistrement de la recette entraînera la création d’un mail à destination de l’administrateur du site. 

![](public/images/md/Aspose.Words.0a26150c-6c33-4bc0-9473-a4068ff84a1a.131.png)

## Bonus 6 - Améliorer les tableaux

Un petit script JS sympa qui permet d’enrichir les tableaux en proposant une recherche des éléments du tableau ainsi que la navigation. 

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.001.png)

A déclarer au niveau du template

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.002.png)

Et d’appeler dans les templates sur lesquels on souhaite l’utiliser

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.003.png)

Possibilité de filtrer le nombre de résultats affichés, naviguer entre les pages de la liste ou de rechercher facilement un élément du tableau. 

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.004.png)

## Étape 15 (et la dernière) - La gestion des requêtes complexes 

Dans le cours que j’ai suivi qui dure près de 30 heures, à aucun moment Lior n’a besoin d’utiliser les classes du repository. Il se sert d’objets déjà existants, créés par le Framework pour gérer toutes les manipulations au niveau de la base de données. 

Je trouve ça remarquable mais ma trop faible expérience du Framework ou la complexité de certaines requêtes ne me le permettent pas.

Je trouve très pratique de définir des requêtes complexes au niveau des classes Repository. J’ai lu qu’il existait plusieurs méthodes pour interroger la base de données. Celle que j’utilise consiste à écrire la requête de manière native (je baigne dans le SQL depuis ma plus tendre enfance :D)

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.005.png)

Et appeler la fonction au niveau du contrôleur. 

![](public/images/md/Aspose.Words.e71f8470-0ce5-452f-8d9c-6c80069515de.006.png)

