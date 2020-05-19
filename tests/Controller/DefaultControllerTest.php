<?php

namespace App\Tests\Controller;

use App\Tests\ConnexionTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    use ConnexionTrait;

    public function testIndexAction()
    {
        $this->login('user1','password');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('a', 'Consulter la liste des tâches à faire');
    }
}
