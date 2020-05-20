<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testCreateTask()
    {
        $task = new Task();
        $now = new \DateTime();
        $user = new User();

        self::assertNull($task->getId());
        $task->setCreatedAt($now);
        self::assertSame($now, $task->getCreatedAt());
        $task->setUser($user);
        self::assertSame($user, $task->getUser());
        $task->setTitle('test');
        self::assertSame('test', $task->getTitle());
        $task->setContent('test');
        self::assertSame('test', $task->getContent());
    }

    public function testToggle()
    {
        $task = new Task();
        self::assertFalse(FALSE, $task->isDone());
        $task->toggle(!$task->isDone());
        self::assertTrue(TRUE, $task->isDone());
    }
}
