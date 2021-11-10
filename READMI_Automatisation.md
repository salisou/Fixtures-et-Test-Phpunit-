![img.png](Gitlab-CI-–-Comment-automatiser-nos-tests.png)

### Gitlab CI – Comment automatiser les tests

#### Comment ça marche ?
##### Gitlab CI marche uniquement avec des dépôt Gitlab. 
##### Rien à configurer, votre dépôt peut accéder directement à la CI de Gitlab.

##### Sur votre projet, à la racine de ce dernier, 
##### on va créer un fichier nommé : “.gitlab-ci.yml”. Ce fichier est le point d’entrée pour la CI pour qu’il s’exécute sur votre projet.

##### On va le configurer et l’utiliser les deux derniers articles (Tests Unitaires, Fixtures) pour vérifier si tout marche comme il faut.

    image: edbizarro/gitlab-ci-pipeline-php:7.2-alpine
    cache:
        paths:
            - vendor/
    
    services:
        - mysql:latest

    stages:
        - build
        - test

    variables:
        MYSQL_ROOT_PASSWORD: root
        MYSQL_USER: homestead
        MYSQL_PASSWORD: secret
        MYSQL_DATABASE: homestead
        DB_HOST: mysql
        GIT_STRATEGY: fetch

    build:
        stage: build
        script:
            - composer install --prefer-dist --no-ansi --no-interaction --no-progress
            - sudo apk add --no-cache zip unzip
    
    test:
    stage: test
    script:
        - php bin/console doctrine:schema:update --force --env=test
        - php bin/console doctrine:fixture:load --no-interaction --env=test
        - ./vendor/bin/simple-phpunit
    
    dependencies:
        - build


### Configuration des tests .env et phpunit

    ###> symfony/framework-bundle ###
    APP_ENV=dev
    APP_SECRET=32bb1968190362d214325d23756ffd65
    DATABASE_URL=mysql://homestead:secret@127.0.0.1/homestead
    #TRUSTED_PROXIES=127.0.0.1,127.0.0.2
    #TRUSTED_HOSTS='^localhost|example\.com$'
    ###< symfony/framework-bundle ###