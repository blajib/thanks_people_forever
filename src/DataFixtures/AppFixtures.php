<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (UserData::USERS as $username => $email) {
            $user = new User();
            $user
                ->setEmail($email)
                ->setUsername($username)
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }
}
