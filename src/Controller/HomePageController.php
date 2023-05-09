<?php

namespace App\Controller;

use App\Entity\ImagesLogement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Logement;
class HomePageController extends AbstractController
{    private ObjectManager $manager;
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

    #[Route('/homepage', name: 'app_home_page')]
    public function index(): Response
    {$logement=$this->repository->findAll();
        return $this->render('home_page/index.html.twig', ['controller' => $this,
          'logements'=>$logement,
        ]);
    }

    #[Route('/homepage/location={location}/date_debut={date_debut}/date_fin={date_fin}/nb_voyageurs={nb_voyageurs}', name: 'app_home_page_location')]
    public function indexId($location,$date_debut,$date_fin,$nb_voyageurs): Response
    {
        $logements=$this->repository->findBySearchBar($location,$date_debut,$date_fin,$nb_voyageurs);

        return $this->render('home_page/index.html.twig', ['controller' => $this,
          'logements'=>$logements,
        ]);
    }

    #[Route('/homepage/testhome', name: 'app_home_page_id')]
    public function indexTestHome(): Response {
        $logements = $this->repository->findReservationByLogement(16);
        return $this->render('home_page/index.html.twig', ['controller' => $this,
            'logements'=>$logements,
        ]);
    }



}
