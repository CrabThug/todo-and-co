<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser()
    {
        $user = new User();
        self::assertNull($user->getId());
        $user->setUsername('demo');
        self::assertSame('demo', $user->getUsername());
        $user->setPassword('demo');
        self::assertSame('demo', $user->getPassword());
        $user->setRoles('demo');
        self::assertContains('demo', $user->getRoles());
        $user->setEmail('demo@demo.fr');
        self::assertSame('demo@demo.fr', $user->getEmail());
        self::assertNull($user->getSalt());
        self::assertNull($user->eraseCredentials());
    }

    public function testTask()
    {
        $user = new User();
        $task = new Task();
        $user->setTask($task);
        self::assertInstanceOf(Task::class, $user->getTask());
    }
}
