<?php

namespace App\DataFixtures;
use App\Entity\User;
Use App\Entity\Logement;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


use vendor\fzaninotto\faker\src\Faker\Factory;

class CommentaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 40; $i++) {
            $commentaire = new Commentaire();

            $commentaire->setText($faker->word);

            $compte = $manager->getRepository(User::class)->find($faker->numberBetween(1, 20));
            $commentaire->setIdUser($compte);

            $logement = $manager->getRepository(Logement::class)->find($faker->numberBetween(1, 20));
            $commentaire->setIdLogement($logement);

            $manager->persist($commentaire);

        }
        $manager->flush();
    }
}
