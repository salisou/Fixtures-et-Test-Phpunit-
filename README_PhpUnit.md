### Travis CI – Comment automatiser nos tests

![img.png](img.png)

#### Sur votre projet, à la racine de ce dernier, on va créer un fichier nommé : “.travis.yml”. 
#### Ce fichier est le point d’entrée de travis pour qu’il s’exécute sur votre projet.
#### On va le configurer et l’utiliser les deux derniers articles (Tests Unitaires, Fixtures) pour vérifier si tout marche comme il faut.


    language: php
    sudo: false
    cache:

    directories:
            - $HOME/.composer/cache
            - $HOME/symfony-bridge/.phpunit
  
    warnings_are_errors: false

    services:
        - mysql

    php:
        - 7.4

    install:
        - composer install --prefer-dist --no-interaction
        - php bin/console doctrine:database:create --env=test
        - php bin/console doctrine:schema:update --force --env=test
        - php bin/console doctrine:fixtures:load -n --env=test
    
    script:
        - ./vendor/bin/simple-phpunit --coverage-text --colors

### Au secours !!! Gary veut nous noyer ! :O
###### Oula oui cela fait peur, mais je vais expliquer cas par cas chaque option, 
###### ceci dit c’est une version simplifiée d’un fichier de configuration pour Travis.

#### language
###### C’est le language en quoi les tests vont être exécuté. On utilisera le PHP.

#### sudo
###### Pas besoin de monter en privilège root pour exécuter les tests.

#### cache
###### Pour éviter d’attendre entre chaque test, on peut mettre en cache 
###### le composer et phpunit afin d’accélérer le processus.

#### warnings_are_errors
###### Alors, je mets par défaut à false pour éviter de me soucier 
###### des fonctionnalités déprécier. Mais si vous voulez vraiment avoir une application 
###### avec l’ensemble de votre code à jour je vous conseille de mettre à true. 
###### Cela peut vous permettre de ne pas avoir une mauvaise surprise sur une mise à jour

#### services
###### L’ensemble des services qui vous permettra de simuler un environnement, 
###### une base de données, un elasticsearch, un rabbitmq etc.
###### Par défaut, il ne charge aucun service pour assurer la performance des tests.

#### Php
###### Comme on va utiliser PHP, 
###### on aura besoin de spécifier les versions d’environnement qu’il aura besoin pour faire fonctionner nos tests. 
###### On peut spécifier plusieurs versions différentes, mais pour notre exemple on aura besoin d’une seule version.

#### install
###### Ah, on y arrive, c’est les scripts qui vont permettre de mettre en place l’environnement de tests. 
###### Pour ma part, j’ai décidé d’installer les bundles dont j’ai besoin, la base de données et les fixtures de notre dernier article.

#### script
###### Ici, on lance les scripts de tests unitaire. 
###### Petite chose que je rajoute c’est un système de coverage pour pouvoir voir si mes tests couvrent l’ensemble de mes fonctionnalités ou pas.

###### Un peu plus de détail
###### Comme vous pouvez le remarquer, il y a des options dans les lignes de commandes qui seront importants à savoir.

#### –env
###### Permet de choisir l’environnement pour exécuter la commande pour nos tests on force celui de tests alors il va utiliser la configuration du fichier “.env.test“.

#### doctrine:fixtures:load -n
###### L’option -n permet de passer à oui la demande de vide la base de données avant d’exécuter les fixtures.

#### Configuration des tests .env et phpunit
###### Maintenant, je vais configurer le projet pour qu’il puisse avoir un environnement de test pour Travis. 
###### Le fichier .env.test sera utile pour différencier notre environnement de production et notre environnement de test.
    
    ###> symfony/framework-bundle ###
    APP_ENV=dev
    APP_SECRET=32bb1968190362d214325d23756ffd65
    DATABASE_URL=mysql://root@127.0.0.1/travis_demo
    #TRUSTED_PROXIES=127.0.0.1,127.0.0.2
    #TRUSTED_HOSTS='^localhost|example\.com$'
    ###< symfony/framework-bundle ###