<?php

namespace App\Controller;

use App\Entity\ImagesLogement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {$logement=$this->repository->findAll();
        return $this->render('home_page/index.html.twig', ['controller' => $this,
          'logements'=>$logement,
        ]);
    }

    #[Route('/homepage/location={location}/date_debut={date_debut}/date_fin={date_fin}/nb_voyageurs={nb_voyageurs}', name: 'app_home_page_location')]
    public function indexId($location,$date_debut,$date_fin,$nb_voyageurs): Response
    {
        $logements=$this->repository->findBySearchBar(ucfirst(strtolower($location)),$date_debut,$date_fin,$nb_voyageurs);

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
    #[Route('/homepage/filtreCarousel={filtrec}', name: 'app_home_page_filtreCarousel')]
    public function indexfiltreCarousel($filtrec): Response
    {
        $logements=$this->repository->findByKeyword($filtrec);

        return $this->render('home_page/index.html.twig', ['controller' => $this,
            'logements'=>$logements,
        ]);
    }
   #[Route('/homepage/location={location}/date_debut={date_debut}/date_fin={date_fin}/nb_voyageurs={nb_voyageurs}/filtreCarousel={filtrec}', name: 'app_home_page_filtrecar')]
    public function indexserachfiltre($location,$date_debut,$date_fin,$nb_voyageurs,$filtrec): Response
    {
        $logements=$this->repository->findBySearchBarfiltre($location,$date_debut,$date_fin,$nb_voyageurs,$filtrec);

        return $this->render('home_page/index.html.twig', ['controller' => $this,
            'logements'=>$logements,
        ]);
    }


    #[Route('/homepage/filtres&prix={prix}&type_logement={type_logement}&chambres={chambres}&lits={lits}&salledeau={salledeau}&type_propriete={type_propriete}',name:'app_home_page_filtre' )]
    public function indexFiltre($prix,$type_logement,$chambres,$lits,$salledeau,$type_propriete): Response
    {
        $logements=$this->repository->findByFiltre($prix,$type_logement,$chambres,$lits,$salledeau,$type_propriete);

        return $this->render('home_page/index.html.twig', ['controller' => $this,
            'logements'=>$logements,
        ]);
    }

#[Route('/homepage/location={location}/date_debut={date_debut}/date_fin={date_fin}/nb_voyageurs={nb_voyageurs}/filtres&prix={prix}&type_logement={type_logement}&chambres={chambres}&lits={lits}&salledeau={salledeau}&type_propriete={type_propriete}', name: 'app_home_page_locationFiltre')]
public function searchBarFiltre($location,$date_debut,$date_fin,$nb_voyageurs,$prix,$type_logement,$chambres,$lits,$salledeau,$type_propriete) : Response
{

    $logements = $this->repository->findBySearchBarFiltres($location,$date_debut,$date_fin,$nb_voyageurs,$prix,$type_logement,$chambres,$lits,$salledeau,$type_propriete);

    return $this->render('home_page/index.html.twig', ['controller' => $this,
        'logements'=>$logements,
    ]);
}






}
