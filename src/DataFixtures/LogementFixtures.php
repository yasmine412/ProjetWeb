<?php

namespace App\DataFixtures;

use App\Entity\Logement;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

require_once 'vendor\fzaninotto\faker\src\autoload.php';
Use vendor\fzaninotto\faker\src\Faker\Factory;

class LogementFixtures extends Fixture
{ public  function  genran(){
    $a=["Villa","Vue sur mer","Montagne","Nature","Arctique","Sport d'hiver","Avec Vue","Camping","Ferme","Piscine","Pieds dans l'eau","Bateau"];
$i=array_rand($a);
return($a[$i]);
}

    public function load(ObjectManager $manager ): void
    {
        $faker=\Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 20; $i++) {
            $logement = new logement();
            $possible_values = array("maison", "appartement", "maison_hôtes", "hôtel");
        $random_value = array_rand($possible_values,1);
            $logement->setTypeLogement($random_value);

            $possible_values= array("entier", "privee", "partagee");
            $random_value = array_rand($possible_values,1);
            $logement->setTypeEspace($random_value);

            $logement->setNumLogement($faker->numberBetween(0,200));
            $logement->setRue($faker->streetName);
            $logement->setPays($faker->country);
            $logement->setVille($faker->city);

            $logement->setNbrChambres($faker->numberBetween(1,60));
            $logement->setNbrLits($faker->numberBetween(1,60));
            $logement->setNbrSdb($faker->numberBetween(1,60));
            $equip=array("wifi" => $faker->numberBetween(0,1),
                "television" => $faker->numberBetween(0,1) ,
                "climatisation" => $faker->numberBetween(0,1) ,
                "Chauffage" => $faker->numberBetween(0,1) ,
                "parking" => $faker->numberBetween(0,1) ,
                "cuisine" => $faker->numberBetween(0,1) ,
                "laveLinge" => $faker->numberBetween(0,1) ,
                "sècheLinge" => $faker->numberBetween(0,1) ,
                "espaceTravail" => $faker->numberBetween(0,1) ,
                "sècheCheveux" => $faker->numberBetween(0,1) ,
                "recharge" => $faker->numberBetween(0,1) ,
                "fer" => $faker->numberBetween(0,1) ,
                "piscine" => $faker->numberBetween(0,1) ,
                "jacuzzi" => $faker->numberBetween(0,1) ,
                "litBebe" => $faker->numberBetween(0,1) ,
                "salleSport" => $faker->numberBetween(0,1) ,
                "barbecue" => $faker->numberBetween(0,1) ,
                "petitDej" => $faker->numberBetween(0,1) ,
                "cheminee" => $faker->numberBetween(0,1) ,
                "detectionMonoxyde" => $faker->numberBetween(0,1) ,
                "detectionFumee" => $faker->numberBetween(0,1) ,
                "fumeur" => $faker->numberBetween(0,1) ,
                "bordMer" => $faker->numberBetween(0,1) ,
                "frontMer" => $faker->numberBetween(0,1) );

            $logement->setEquipements($equip);

            $logement->setTitre($faker->realText(20));
            $logement->setDescription($faker->realText(30).$this->genran().$faker->realText(30));
            $logement->setPrixNuite(strval($faker->randomFloat(NULL, 0,2000)));

            $compte= $manager->getRepository(User::class)->find($faker->numberBetween(1,20));
            $logement->setIdUser($compte);


            $manager->persist($logement);
        }


        $manager->flush();
    }
}
