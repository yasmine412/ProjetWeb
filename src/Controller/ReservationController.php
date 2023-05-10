<?php

namespace App\Controller;

use App\Entity\ImagesLogement;
use App\Entity\Logement;
use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{private ObjectManager $manager;
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
    #[Route('/reservation', name: 'app_reservation_index')]
public  function index1()
    {}

    #[Route('/reservation/{id}', name: 'app_reservation_index_id')]
    public function index($id): Response
    {$logement=$this->repository->findByUser($id);
        return $this->render('reservation/Reservation.html.twig', ['controller' => $this,
            'logements'=>$logement,'id'=>$id]);

    }
    #[Route('/reservation/{id}/datevenir', name: 'app_reservation_index_id_date')]
    public function index3($id): Response
    {$logement=$this->repository->findByUserDateVenir($id);
        return $this->render('reservation/Reservation.html.twig', ['controller' => $this,
            'logements'=>$logement,'id'=>$id]);

    }
    #[Route('/reservation/{id}/datefin', name: 'app_reservation_index_id_dateter')]
    public function index4($id): Response
    {$logement=$this->repository->findByUserDateter($id);
        return $this->render('reservation/Reservation.html.twig', ['controller' => $this,
            'logements'=>$logement,'id'=>$id]);

    }
    #[Route('/reservation/{id}/encours', name: 'app_reservation_index_id_encours')]
    public function index5($id): Response
    {$logement=$this->repository->findByUserencours($id);
        return $this->render('reservation/Reservation.html.twig', ['controller' => $this,
            'logements'=>$logement,'id'=>$id]);

    }
}
