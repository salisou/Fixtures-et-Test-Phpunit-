### Symfony – Comment mettre en place des Fixtures

#### Pour utiliser les fixtures, il faut l’installer dans notre projet Symfony via composer :
    $ composer require --dev orm-fixtures

#### Ensuite, une configuration a besoin d’être faite dans le dossier config.
    
    config/bundles.php
    return [
    // ...
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
    ];


#### Mise en place
#### Les fixtures se situent dans le dossier src, le dossier s’appelle DataFixtures. 
#### Je vais créer un projet Symfony avec une entité simple : Article.

#### uri string, title string

#### Comme vous pouvez le remarquer, je reutilise la même entité que mon article précédent pour vous permettre de ne pas vous perdre entre deux articles. 
#### Dès à présent on va créer notre Fixture de l’entité Article.

    // src/DataFixtures/ArticleFixtures.php
    
    namespace App\DataFixtures;
    
    use App\Entity\Article;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    
    class ArticleFixtures extends Fixture
    {
        public function load(ObjectManager $manager)
        {
            $title = "Titre Fixture";
            $uri = "Uri Fixture";
            $article = new Article();
            $article->setTitle($title);
            $article->setUri($uri);
            $manager->persist($article);
            $manager->flush();
        }
    }

### La fixture ci-dessus va permettre de créer une entrée dans votre base de donnée mais celle ci-dessous on peut serialiser X entrée.

    // src/DataFixtures/ArticleFixtures.php
    
    namespace App\DataFixtures;
    
    use App\Entity\Article;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    
    class ArticleFixtures extends Fixture
    {
        public function load(ObjectManager $manager)
        {
            for ($count = 0; $count < 20; $count++) 
            {
                $article = new Article();
                $article->setTitle("Titre " . $count);
                $article->setUri("Uri Fixture" . $count);
                $manager->persist($article);
            }
            $manager->flush();
        }
    }

#### Maintenant j’ai 20 articles dans ma base de donnée, 
#### je voudrais maintenant le lier à mon entité User. 
#### Dans un premier temps, je vais créer mon entité User.

    // src/Entity/User.php
    
    namespace App/Entity;
    
    class User
    {
        private $firstName;
        private $lastName;
        public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
        public function getFirstName()
        {
            return $this->firstName;
        }
        public function setLastName(string $lastName) 
        {
            $this->lastName = $lastName;
            return $this;
        }
        public function getLastName()
        {
            return $this->lastName;
        }
    }


#### Et sa Fixture

    // src/DataFixtures/UserFixtures.php
    namespace App\DataFixtures;
    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    
    class UserFixtures extends Fixture
    { 
        public const USER_REFERENCE = 'user-gary';
       
        public function load(ObjectManager $manager)
        {
            $user = new User();
            $user->setFirstName("Gary");
            $user->setLastName("Houbre");
            $this->addReference(self::USER_REFERENCE, $user);
    
            $manager->persist($user);
            $manager->flush();
        }
    }

#### Une nouvelle fonctionnalité s’est glissée dans la Fixture de l’entité User, 
#### le addReference, ce qui permet de pouvoir lier les fixtures entre elles. Désormais je dois ajouter un champ user à mon entité Article et modifier sa Fixture.

    // src/Entity/Article.php
    namespace App/Entity;

    class Article {

        private $uri;
        private $title;
        private $user;
    public function setUri(string $uri)
    {
    $this->uri = strtolower(str_replace(' ', '_', $uri));
    return $this;
    }
    
        public function getUri()
        {
            return $this->uri;
        }
        public function setTitle(string $title) 
        {
            $this->title = $title;
            return $this;
        }
        public function getTitle()
        {
            return $this->title;
        }
        
        public function setUser(User $user)
        {
            $this->user = $user;
            return $this;
        }
        public function getUser()
        {
            return $this-user;
        }
    }

#### Ajoutons le user dans la fixture de l’article

    // src/DataFixtures/ArticleFixtures.php
    namespace App\DataFixtures;
    
    use App\Entity\Article;
    use App\DataFixtures\UserFixtures;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
   
    class ArticleFixtures extends Fixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            for ($count = 0; $count < 20; $count++) {
            $article = new Article();
            $article->setTitle("Titre " . $count);
            $article->setUri("Uri Fixture" . $count);
            $article->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $manager->persist($article);
        }
            $manager->flush();
        }
    }

#### Maintenant que j’ai rajouté la référence, il y a une problématique: 
#### quand vous allez lancer la commande pour les fixtures, 
#### la commande ne saura pas l’ordre de chaque Fixture. 
#### Cela peut poser problème si la Fixture de 
#### l’entité Article se lance avant celle de l’User.

#### Une des solutions consiste à ajouter une fonction 
## getDependencies 
#### qui permet de lister les Fixtures dont elle a besoin (avant qu’elle ne s’exécute).

    // src/DataFixtures/ArticleFixtures.php
    namespace App\DataFixtures;
    use App\DataFixtures\UserFixtures;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    
    class ArticleFixtures extends Fixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
    {
        // ...
    }
        public function getDependencies()
    {
        return array(
             UserFixtures::class,
            );
        }
    }

### Groupe de Fixture

#### Par défaut, on exécuterai l’ensemble des Fixtures. 
#### Mais on peut créer des groupes de Fixtures qui auront 
#### comme objectif d’exécuter un ensemble de fixture.

    // src/DataFixtures/UserFixtures.php
    namespace App\DataFixtures;
   
    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    class UserFixtures extends Fixture implements FixtureGroupInterface
    
    {
        public const USER_REFERENCE = 'user-gary';
        public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("Gary");
        $user->setLastName("Houbre");
        $this->addReference(self::USER_REFERENCE, $user);

        $manager->persist($user);
        $manager->flush();
    }
        public static function getGroups(): array
    {
        return ['group1', 'group2'];
    }

#### Pour lancer les Fixtures, il y a plusieurs façons de faire, 
#### soit l’ensemble des Fixtures, soit dans un groupe spécifique 
#### ou une Fixture spécifique.

#### L'ensemble des Fixtures
    php bin/console doctrine:fixtures:load
#### Un groupe de Fixture
    php bin/console doctrine:fixtures:load --group=group1
#### Plusieurs groupes de Fixture
    php bin/console doctrine:fixtures:load --group=group1 --group=group2
#### Une Fixture en particulier
    php bin/console doctrine:fixtures:load --group=UserFixtures
#### Pour les tests utilisez 
    bin/phpunit --testdox 

#### Désormais, vous savez utiliser les Fixtures avec des liaisons entre deux Fixtures. 
#### Cela s’avère pratique pour mettre en place rapidement un environnement avec des fausses data, 
#### ou pour lancer des tests. Ce qu’on vera sur le prochain article.