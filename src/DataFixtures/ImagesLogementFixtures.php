<?php

namespace App\DataFixtures;

use App\Entity\ImagesLogement;
use App\Entity\Logement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


use vendor\fzaninotto\faker\src\Faker\Factory;

class ImagesLogementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 35 ; $i < 51; $i++) {
            for ($j=1;$j<6;$j++){
            $imageLogement = new ImagesLogement();
            $imageLogement->setName($faker->word);

            $pathToWebpFile = 'public/assets/images/maison '.($i-34)."/".$j.".webp";
            $fileContents = file_get_contents($pathToWebpFile);
            $imageLogement->setData($fileContents);

            $logement= $manager->getRepository(Logement::class)->find($i);
            $imageLogement->setIdLogement($logement);

            $manager->persist($imageLogement);
        }}

        $manager->flush();
    }
}
