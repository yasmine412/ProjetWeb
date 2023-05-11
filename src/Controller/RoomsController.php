<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Logement;

use App\Repository\ReservationRepository;
use Doctrine\Persistence\ObjectRepository;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use App\Repository\ImagesLogementRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomsController extends AbstractController
{   private $entityManager;


    #[Route('/homepage/rooms/{id<\d+>}', name: 'app_rooms')]
    public function index(logement $logement = null,
                          CommentaireRepository $commentaireRepository,
                          UserRepository $compteRepository,
                          EntityManagerInterface $entityManager,
                          ImagesLogementRepository $ImagesLogementRepository,
                          ReservationRepository $reservationRepository,

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
        $imag=[];
        $images = $ImagesLogementRepository->findBy(['idLogement' => $logement->getId()]);
        $nb=0;
        foreach ($images as $key=>$value)
        {$value->setData(base64_encode(stream_get_contents($value->getData())));
            if ($nb==0)
            { $image1=$images[0];
                $nb=$nb+1;}
            else
            {
                $imag[$key]=$images[$key];
            }

        }

        $prix=$logement->getprix_nuite();


        $reservations = $reservationRepository->findBy(['idLogement' =>$logement->getId()]);





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
            'images'=>$images,
            'imag'=>$imag,
            'prix'=>$prix,
            'reservations' => $reservations,
        ]);
    }
}



