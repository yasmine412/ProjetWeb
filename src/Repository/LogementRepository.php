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
            $datedebut = "1700-01-01";
        }
        if ($datefin == " ") {
            $datefin = "3000-01-01";
        }
        if ($nb_voyageurs == " ") {
            $nb_voyageurs = 0;
        }

        $conn = new PDO('mysql:host=localhost;dbname=ymaradb' ,'root' ,'');


        $sql = 'SELECT * FROM logement l WHERE pays LIKE :location AND nbr_lits >= :nb_voyageurs
            AND l.id NOT IN (
                SELECT id_logement_id FROM reservation r1 
                WHERE r1.date_debut BETWEEN :datedebut AND :datefin
                    /*OR r1.date_fin BETWEEN :datedebut AND :datefin*/
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


    /*public function findBySearchBar($location,$datedebut,$datefin,$nb_voyageurs) {
        if ($location == " ") {
            $location = "";
        }
        if ($datedebut == " ") {
            $datedebut = "1700-01-01";
        }
        if ($datefin == " ") {
            $datefin = "3000-01-01";
        }
        if ($nb_voyageurs == " ") {
            $nb_voyageurs = 0;
        }
        $qb = $this->createQueryBuilder('l');
            $qb->select('r.idLogement')
               ->from(Reservation::class, 'r')
                ->where('l.id NOT IN (SELECT idLogement FROM  App\Entity\Reservation r1 WHERE r1.dateDebut BETWEEN :datedebut AND :datefin OR r1.dateFin BETWEEN :datedebut AND :datefin )')
            ->andWhere('l.ville LIKE :location')
            ->andWhere('l.NbrLits >= :nb_voyageurs')
            ->setParameter('datedebut', $datedebut)
            ->setParameter('datefin', $datefin)
            ->setParameter('location', '%'.$location.'%')
            ->setParameter('nb_voyageurs', $nb_voyageurs);
        return $qb->getQuery()->getResult();
    } */

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
