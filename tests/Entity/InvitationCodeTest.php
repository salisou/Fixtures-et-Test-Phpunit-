<?php

namespace App\Tests\Entity;

use App\Entity\InvilideCode;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvitationCodeTest extends kernelTestCase
{

    public function getEntity(): InvilideCode
    {
        // creation de mon entity
        return (new InvilideCode())
            ->setCode('12345')                            // je luis donne un code valide
            ->setDescription('Description de test')  // je luis donne une description
            ->setExpireAt(new \DateTimeImmutable());           // je luis donne une date dexpiration

    }

    public function assertHasErrors(InvilideCode $code, int $number = 0)
    {
        self::bootKernel();  // je valide mon code

        //je valide mon code en recuperant mon objet (Entity)
        // et je recupère un objet qui est une liste d'erreur
        $error = self::$container->get('validator')->validate($code);

        // je m'attends à obtenire un nombre d'erreur indefinit
        $this->assertCount($number, $error);

    }

    public function testValidEntity ()
    {
        // je m'attant à avoir aucunne erreur
        $this->assertHasErrors($this->getEntity(), 0) ; // j'appel ma function get entity
    }

    public function testInvalidCodeEntity ()
    {
        $this->assertHasErrors($this->getEntity()->setCode('12a54'), 1); // je m'attant à avoir une erreur
        $this->assertHasErrors($this->getEntity()->setCode('1254'), 1); // je m'attant à avoir une erreur

    }
}
