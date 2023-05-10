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

        $faker=\Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 20; $i++) {
            $compte= new User();
            $compte->setNom($faker->lastName);
            $compte->setEmail($faker->email);

            $pathToWebpFile = 'public/assets/user.png';
            $fileContents = file_get_contents($pathToWebpFile);
            $compte->setPhoto($fileContents);
            $compte->setPassword($faker->password());
            $compte->setPrenom($faker->firstName());
            $compte->setAge(strval($faker->numberBetween(19,60)));
            $compte->setTelephone(strval($faker->numberBetween(10000000,99999999)));
            $manager->persist($compte);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return['user'];
    }
}
