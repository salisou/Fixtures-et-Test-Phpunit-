### Exemple simple de cas de test PHPUnit

#### Dans cet article, nous verrons comment créer et tester une classe PHP simple, disons Calculator, en utilisant PHPUnit.√
#### 1. Créez un répertoire appelé Calculatrice avec la commande ci-dessous
    $mkdir Calculator
#### 2. Ajouter Composer au répertoire Calculatrice
##### Exécutez ensuite la commande ci-dessous pour ajouter l'outil de gestion des dépendances.
    php installer
#### 3. Ajouter la bibliothèque PHPUnit à ce projet
##### Exécutez la commande ci-dessous à la racine du projet.
    php composer.phar require --dev phpunit/phpunit
#### 4. Activer le chargement automatique de classe pour ce projet

##### Nous pouvons activer autoload dans notre projet en ajoutant la construction autoload composer.
##### json comme indiqué ci-dessous
    {
        "autoload": {
            "classmap": [
                        "src/"
                ]
        },
        
        "require-dev": {
        "phpunit/phpunit": "^7.0"
        }
    }

#### 5. Créez des répertoires srcet testsdans le répertoire racine du projet
    $mkdir src
    $mkdir tests
#### 6. Créez un fichier de classe appelé Calculator.php dans le répertoiresrc
    <?php
        class Calculator{
            public function sum($n1, $n2){
                return $n1 + $n2;
            }
        }
##### La classe Calculator a une méthode appelée sum qui reçoit deux arguments et renvoie sa somme
#### 8. Exécution du test
##### Nous pouvons exécuter le test en exécutant la commande ci-dessous à la racine du projet
    $./vendor/bin/phpunit --testdox tests/CalculatorTest.php


