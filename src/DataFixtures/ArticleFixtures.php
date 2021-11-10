<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    /*
    public function load(ObjectManager $manager): void
    {
        $title = "Creation Fixtures";
        $uri = "Creation Uri";

        $article = new Article();

        $article->setTitle($title);
        $article->setUri($uri);

        $manager->persist($article);

        $manager->flush();
    }*/

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 20; $count++) {
            $article = new Article();
            $article->setTitle("Titre " . $count);
            $article->setUri("Uri Fixture" . $count);

            //ici j'ajoute le user dans la fixture de l’article
            $article->setUser($this->getReference(UserFixtures::USER_REFERENCE));

            $manager->persist($article);
        }
        $manager->flush();
    }

    /*
     * Une des solutions consiste à ajouter une fonction
     *
     * getDependencies qui permet de lister les Fixtures dont elle a besoin (avant qu’elle ne s’exécute).
     */


    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
