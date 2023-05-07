<?php

namespace App\DataFixtures;

use App\Entity\Compte;
use App\Entity\Logement;
use App\Entity\Réservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



use vendor\fzaninotto\faker\src\Faker\Factory;
class RéservationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 40; $i++) {
            $reservation=new Réservation();
            $j=$faker->dateTime();
            $reservation->setDateDébut($j);
            $k=$faker->dateTime();
            while ($j>=$k){$k=$faker->dateTime();}
            $reservation->setDateFin($k);

            $compte = $manager->getRepository(Compte::class)->find($faker->numberBetween(1, 20));
        $reservation->setIdLocataire($compte);

        $compte = $manager->getRepository(Compte::class)->find($faker->numberBetween(1, 20));
            $reservation->setIdProprietaire($compte);

        $logement = $manager->getRepository(Logement::class)->find($faker->numberBetween(1, 16));
        $reservation->setIdLogement($logement);

            $manager->persist($reservation);
    }
        $manager->flush();
    }
}
