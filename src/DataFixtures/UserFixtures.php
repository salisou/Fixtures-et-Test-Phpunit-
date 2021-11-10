<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'user-moussa';

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail("msalisou1@domaine.io");
        $user->setPassword("0000");
        $user->setFirstName("moussa");
        $user->setLastName("saliosu");

        $this->addReference(self::USER_REFERENCE, $user);

        $manager->persist($user);
        $manager->flush();
    }

    public static function getGroup(): array
    {
        return ['group1', 'group2'];
    }
}