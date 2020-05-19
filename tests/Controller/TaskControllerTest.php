<?php

namespace App\Tests\Controller;

use App\Tests\ConnexionTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    use ConnexionTrait;

    private $taskRepository;

    protected function setUp(): void
    {
        $this->login('user1', 'password');
        $kernel = self::bootKernel();
        $this->taskRepository = $kernel->getContainer()->get('doctrine')->getRepository('App:Task');
    }

    public function testListAction()
    {
        $this->client->request('GET', '/tasks');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div .thumbnail>.caption');
    }

    public function testCreateAction()
    {
        $this->crawler = $this->client->request('GET', '/tasks/create');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form #task_title');
        $form = $this->crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'demo_title';
        $form['task[content]'] = 'demo_content';
        $this->client->submit($form);
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div .alert-success');
    }

    public function testToggleTaskAction()
    {
        $task = $this->taskRepository->findOneBy(['title' => 'demo_title']);
        if ($task) {
            $this->crawler = $this->client->request('GET', '/tasks/' . $task->getId() .'/toggle');
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('div .alert-success');
        }
        $task ?: self::assertNull($task);
    }

    public function testEditAction()
    {
        $task = $this->taskRepository->findOneBy(['title' => 'demo_title']);
        if ($task) {
            $this->crawler = $this->client->request('GET', '/tasks/' . $task->getId() . '/edit');
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('form #task_title');
            $form = $this->crawler->selectButton('Modifier')->form();
            $form['task[title]'] = 'demo_title';
            $form['task[content]'] = 'demo_content_updated';
            $this->client->submit($form);
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('div .alert-success');
        }
        $task ?: self::assertNull($task);
    }

    public function testDeleteTaskAction()
    {
        $task = $this->taskRepository->findOneBy(['title' => 'demo_title']);
        $task2 = $this->taskRepository->findOneBy(['title' => 'user2']);
        if ($task) {
            $this->crawler = $this->client->request('GET', '/tasks/' . $task->getId() . '/delete');
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('div .alert-success');
        }
        if ($task2) {
            $this->crawler = $this->client->request('GET', '/tasks/' . $task2->getId() . '/delete');
            self::assertResponseIsSuccessful();
            self::assertSelectorExists('div .alert-danger');
        }
        $task ?: self::assertNull($task);
        $task2 ?: self::assertNull($task2);
    }
}
