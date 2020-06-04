<?php

namespace App\Tests\Controller;

use App\Tests\ConnexionTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    use ConnexionTrait;

    private $userRepository;
    private $em;

    protected function setUp(): void
    {
        $this->login('admin', 'password');
        $kernel = self::bootKernel();
        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->userRepository = $kernel->getContainer()->get('doctrine')->getRepository('App:User');
    }

    public function testListAction()
    {
        $this->client->request('GET', '/users');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div .row>.table');
    }

    public function testCreateAction()
    {
        if ($try = $this->userRepository->findOneBy(['username' => 'demo'])) {
            $this->em->remove($try);
            $this->em->flush();
        }
        $this->crawler = $this->client->request('GET', '/users/create');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form #user');
        $form = $this->crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'demo';
        $form['user[password][first]'] = 'password';
        $form['user[password][second]'] = 'password';
        $form['user[email]'] = 'demo@demo.fr';
        $form['user[roles]'] = 'ROLE_USER';
        $this->client->submit($form);
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div .alert-success');
    }

    public function testEditAction()
    {
        $user = $this->userRepository->findOneBy(['username' => 'demo']);
        if ($user) {
            $this->crawler = $this->client->request('GET', '/users/' . $user->getId() . '/edit');
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('.row #user');
            $form = $this->crawler->selectButton('Modifier')->form();
            $form['user[username]'] = 'demo';
            $form['user[password][first]'] = 'password';
            $form['user[password][second]'] = 'password';
            $form['user[email]'] = 'demo_updated@demo.fr';
            $form['user[roles]'] = 'ROLE_USER';
            $this->client->submit($form);
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('div .alert-success');
            $this->em->remove($user);
            $this->em->flush();
        }
        $user ?: self::assertNull($user);
    }
}
