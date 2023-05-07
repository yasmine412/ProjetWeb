<?php

namespace App\DataFixtures;


use App\Entity\Compte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
require_once 'vendor\fzaninotto\faker\src\autoload.php';
USe vendor\fzaninotto\faker\src\Faker\Factory;



class CompteFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker=\Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 20; $i++) {
        $compte= new Compte();
            $compte->setNom($faker->lastName);
            $compte->setEmail($faker->email);

            $pathToWebpFile = 'public/assets/user.png';
            $fileContents = file_get_contents($pathToWebpFile);
            $compte->setPhoto($fileContents);
            $compte->setPassword($faker->password());
            $compte->setPrénom($faker->firstName());
            $compte->setDateNaissance($faker->dateTime());
            $compte->setTelephone(strval($faker->numberBetween(10000000,99999999)));
            $manager->persist($compte);
        }

        $manager->flush();
    }
}
