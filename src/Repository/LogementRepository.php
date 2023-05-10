<?php

namespace App\Repository;

use App\Entity\Logement;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

/**
 * @extends ServiceEntityRepository<Logement>
 *
 * @method Logement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logement[]    findAll()
 * @method Logement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logement::class);
    }

    public function save(Logement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Logement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findReservationByLogement($idLogement) {
        $qb = $this->createQueryBuilder('l');
        $qb->innerJoin(Reservation::class, 'r', 'WITH', 'r.idLogement = l.id');
        return $qb->getQuery()->getResult();

    }

    /**
     * @throws Exception
     */
    public function findBySearchBar($location, $datedebut, $datefin, $nb_voyageurs) {
        if ($location == " ") {
            $location = "";
        }
        if ($datedebut == " ") {
            $datedebut = "";
        }
        if ($datefin == " ") {
            $datefin = "";
        }
        if ($nb_voyageurs == " ") {
            $nb_voyageurs = 0;
        }

        $conn = new PDO('mysql:host=localhost;dbname=ymaradb' ,'root' ,'');


        $sql = 'SELECT * FROM logement l WHERE pays LIKE :location AND nbr_lits >= :nb_voyageurs
            AND l.id NOT IN (
                SELECT id_logement_id FROM reservation r1 
                WHERE (DATE(r1.date_debut) > :datedebut AND DATE(r1.date_fin) < DATE(:datefin))
                    OR (DATE(r1.date_fin) > :datedebut AND DATE(r1.date_fin) < DATE(:datefin))
            )
        ';

        $stmt = $conn -> prepare($sql);
        $stmt -> execute(['location' => '%'.$location.'%',
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'nb_voyageurs' => $nb_voyageurs
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;

    }

    public function findByKeyword($mot)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.Description LIKE :mot')
            ->setParameter('mot', '%' . $mot . '%')
            ->getQuery()
            ->getResult();
    }
    public function findBySearchBarfiltre($location, $datedebut, $datefin, $nb_voyageurs,$filtrec) {
        if ($location == " ") {
            $location = "";
        }
        if ($datedebut == " ") {
            $datedebut = "";
        }
        if ($datefin == " ") {
            $datefin = "";
        }
        if ($nb_voyageurs == " ") {
            $nb_voyageurs = 0;
        }

        $conn = new PDO('mysql:host=localhost;dbname=ymaradb' ,'root' ,'');


        $sql = 'SELECT * FROM logement l WHERE pays LIKE :location AND nbr_lits >= :nb_voyageurs AND Description LIKE :filtrec
            AND l.id NOT IN (
                SELECT id_logement_id FROM reservation r1 
                WHERE (DATE(r1.date_debut) > :datedebut AND DATE(r1.date_fin) < DATE(:datefin))
                    OR (DATE(r1.date_fin) > :datedebut AND DATE(r1.date_fin) < DATE(:datefin))
                
            )
        ';

        $stmt = $conn -> prepare($sql);
        $stmt -> execute(['location' => '%'.$location.'%',
            'datedebut' => $datedebut,
            'datefin' => $datefin,
            'nb_voyageurs' => $nb_voyageurs,
            'filtrec' => '%'.$filtrec.'%'
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;

    }

    public function findByFiltre($prix,$type_logement,$chambres,$lits,$salledeau,$type_propriete) {
        if ($type_logement == " ") {
            $type_logement = "";
        }
        if ($chambres=="Tout") {
            $chambres = 0;
        }
        if ($lits=="Tout") {
            $lits = 0;
        }
        if ($salledeau=="Tout") {
            $salledeau = 0;
        }
        if ($type_propriete=="blank") {
            $type_propriete = "";
        }
        $typeProp = array(
            "maison" => 0,
            "appartement" => 1,
            "maison-dhotes" => 2,
            "hotel" => 3,
            "" => 7,
        );

        $typeLog = array(
            "logement_entier" => 0,
            "chambre_privee" => 1,
            "chambre_partagee" => 2,
            "" => 7
        );

        $type_logement = $typeLog[$type_logement];
        $type_propriete = $typeProp[$type_propriete];
        $chambres = (int)$chambres;
        $lits = (int)$lits;
        $salledeau = (int)$salledeau;


        $conn = new PDO('mysql:host=localhost;dbname=ymaradb', 'root', '');
        $sql = 'SELECT * FROM logement l WHERE 
         prix_nuité <= ?
       AND nbr_chambres >= ?
       AND nbr_lits >= ?
       AND nbr_sdb >= ?';
        if (($type_propriete == 7)||($type_logement == 7)) {
            if ($type_propriete != 7) {
                $sql = $sql . ' AND type_logement = ?';
            }
            if ($type_logement != 7) {
                $sql = $sql . ' AND type_espace = ?';
            }
        }
        else {
            $sql = $sql . ' AND type_logement = ? AND type_espace = ?';
        }


        $prix=(int)$prix;

        $stmt = $conn->prepare($sql);
        if (($type_logement == 7)&&($type_propriete == 7)) {
            $stmt->execute([$prix, $chambres, $lits, $salledeau]);
        }
        else if ($type_logement == 7) {
            $stmt->execute([$prix, $chambres, $lits, $salledeau, $type_propriete]);
        }
        else if ($type_propriete == 7) {
            $stmt->execute([$prix, $chambres, $lits, $salledeau, $type_logement]);
        }
        else {
            $stmt->execute([$prix, $chambres, $lits, $salledeau, $type_propriete, $type_logement]);
        }

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /*public function findByPays($pays): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.Pays = :val')
            ->setParameter('val', $pays)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    } */

//    /**
//     * @return Logement[] Returns an array of Logement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Logement
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
