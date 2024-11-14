<?php

namespace App\DataFixtures;

use App\Entity\Thanks;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (UserData::USERS as $username => $email) {
            $user = new User();
            $user
                ->setEmail($email)
                ->setUsername($username);

            $manager->persist($user);
        }

        $manager->flush();

        foreach (ThanksData::THANKS as $fromUser => $thank) {
            $thanks = new Thanks();

            $thanks
                ->setByUser($this->userRepository->findOneBy(['username' => $fromUser]))
                ->setToUser($this->userRepository->findOneBy(['username' => $thank['toUser']]))
                ->setDescription($thank['description'])
                ->setDate(new \DateTime());

            $manager->persist($thanks);
        }

        $manager->flush();
    }
}
