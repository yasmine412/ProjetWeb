<?php

namespace App\DataFixtures;
use App\Entity\Compte;
Use App\Entity\Logement;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


require_once 'vendor\fzaninotto\faker\src\autoload.php';

use vendor\fzaninotto\faker\src\Faker\Factory;

class CommentaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 40; $i++) {
            $commentaire = new Commentaire();

            $commentaire->setText($faker->word);

            $compte = $manager->getRepository(Compte::class)->find($faker->numberBetween(1, 20));
            $commentaire->setIdCompte($compte);

            $logement = $manager->getRepository(Logement::class)->find($faker->numberBetween(1, 16));
            $commentaire->setIdLogement($logement);

            $manager->persist($commentaire);

        }
        $manager->flush();
    }
}
