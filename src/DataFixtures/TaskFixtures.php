<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository('App:User')->findAll();

        foreach ($users as $u) {
            $task = new Task();
            $task->setUser($u);
            $task->setTitle($u->getUsername());
            $task->setContent($u->getUsername());
            $task->setCreatedAt(new \DateTime());
            $manager->persist($task);
        }

        $task = new Task();
        $task->setTitle('anonyme');
        $task->setContent('anonyme');
        $task->setCreatedAt(new \DateTime());
        $manager->persist($task);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
