<?php

namespace App\Controller;
use App\Entity\ImagesLogement;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Cassandra\Date;
use DateTime;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Logement;

use App\Repository\ReservationRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use App\Repository\ImagesLogementRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomsController extends AbstractController
{


    private ObjectManager $manager;
    private ObjectRepository $repository;
    private ObjectRepository $repositoryImage;


    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->manager->getRepository(Logement::class);
        $this->repositoryImage = $this->manager->getRepository(ImagesLogement::class);

    }

    public function imageParId($id){
        $images = $this->repositoryImage->findBy(['idLogement'=>$id]);
        foreach ($images as $image)
        {$image->setData(base64_encode(stream_get_contents($image->getData())));}


        return $images;
    }

    #[Route('/homepage/rooms/{id<\d+>}', name: 'app_rooms')]
    public function index(logement $logement = null,
                          CommentaireRepository $commentaireRepository,
                          UserRepository $compteRepository,
                          ImagesLogementRepository $ImagesLogementRepository,
                          ReservationRepository $reservationRepository,
                          Request $request,
                          ManagerRegistry $managerRegistry,

    ):Response
    {
        // pour extraire les equipements
        $equipements = $logement->getEquipements();
        $equipements_present = [];
        $equipements_first = [];
        $nb=0;
        foreach ($equipements as $nom_equipement => $valeur) {
            if ($valeur == 1) {
                $equipements_present[] = $nom_equipement;
                $nb=$nb+1;
                if ($nb<9)
                    $equipements_first[] = $nom_equipement;

            }
        }

        $comments = $commentaireRepository->findBy(['id_logement' => $logement->getId()]);

        $nbCommentaire=0;
        $commentsWithAuthor = [];
        foreach ($comments as $comment) {
            $nbCommentaire=$nbCommentaire+1;
            $authorId = $comment->getIdUser();
            $compte =$compteRepository->find($authorId);
            $authorName = $compte->getNom();
            $commentsWithAuthor[$comment->getId()] = [
                'text' => $comment->getText(),
                'author_id' => $authorId,
                'author_name' => $authorName,
            ];
        }

        // type du logement
        $TypeLogement = $logement->getTypeLogement();
        if ($TypeLogement==0)
        { $TypeLog='Maison';}
        else if ($TypeLogement==1)
        { $TypeLog='Appartement';}
        else if ($TypeLogement==2)
        { $TypeLog='Maison d hote';}
        else { $TypeLog='Hotel';}


        $TypeEspace = $logement->getTypeEspace();
        if ($TypeEspace==0)
        { $TypeEs='Logement entier';}
        else if ($TypeEspace==1)
        { $TypeEs='Chambre privée';}
        else if ($TypeEspace==2)
        { $TypeEs='Chanbre partagée ';}



        $idProp=$logement->getIdUser();
        $compteProp =$compteRepository->find($idProp);
        $PropName=$compteProp->getNom();

        $pays=$logement->getPays();
        $ville=$logement->getVille();


        //les images du logement

        /*$images = $ImagesLogementRepository->findBy(['idLogement' => $logement->getId()]);
        foreach ($images as $image)
        {$image->setData(base64_encode(stream_get_contents($image->getData())));}*/



        $prix=$logement->getprix_nuite();

        $reservation= new Reservation();
        $form=$this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);

        $reservations = $reservationRepository->findBy(['idLogement' =>$logement->getId()]);


            $dateArrivee =$form->get('DateDebut')->getData();
            $dateDepart =$form->get('DateFin')->getData();


            $b=1;
                foreach ( $reservations as $reservation) {
                    if (
                        (($reservation->getDateDebut() < $dateDepart) && ($reservation->getDateFin() > $dateDepart))||
                        (($reservation->getDateDebut() < $dateArrivee) && ($reservation->getDateFin() > $dateArrivee))||
                        (($reservation->getDateDebut() > $dateArrivee) && ($reservation->getDateFin() < $dateDepart))
                    )
                    {
                        $b = 0;
                        $this->addFlash('error_date','Ces dates ne sont pas disponibles');
                    }
                }

        if ($form->isSubmitted()) {
            if ($this->getUser())
            {

            if ($b){
                $reservation->setIdLocataire($this->getUser());
                $reservation->setIdLogement($logement);
                $reservation->setIdProprietaire($compteProp);
                $manager = $managerRegistry->getManager();
                $manager->persist($reservation);
               $manager->flush();
                $id=$this->getUser()->getId();
               return $this->redirectToRoute('app_reservation_index_id',
                   ['logements'=>$logement,
                       'id'=>$id]);

        }
          /* else{
                $this->addFlash('error_date','Ces dates ne sont pas disponibles');
            }*/
            }

            else
            {
                return $this->redirectToRoute('app_login');
            }

            }





        return $this->render('rooms/index.html.twig',[
            'logement'=>$logement,
            'equipements_present' => $equipements_present,
            'equipments_first'=> $equipements_first,
            'comments' => $comments,
            'commentsWithAuthor'=>$commentsWithAuthor,
            'TypeLog'=>$TypeLog,
            'TypeEs'=> $TypeEs,
            'PropName'=>$PropName,
            'nbCommentaire'=>$nbCommentaire,
            'pays'=>$pays,
            'ville'=>$ville,
            //'images'=>$images,
            'prix'=>$prix,
            'reservations' => $reservations,
            'controller' => $this,
            'form'=>$form->createView()

        ]);
    }
}



