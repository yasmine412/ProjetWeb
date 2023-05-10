<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Userfixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setEmail('rezgui012@gmail.com');
        $user->setPassword($this->hasher->hashPassword($user,'cristiano'));
        $user1 = new User();
        $user1->setEmail('rezgui0120@gmail.com');
        $user1->setPassword($this->hasher->hashPassword($user1,'cristiano1'));
        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return['user'];
    }
}
