<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = ['user1', 'user2', 'admin'];

        foreach ($users as $u) {
            $user = new User();
            $user->setUsername($u);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
            $user->setEmail($u . '@demo.fr');
            $user->setRoles($u === 'admin' ? 'ROLE_ADMIN' : '');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
