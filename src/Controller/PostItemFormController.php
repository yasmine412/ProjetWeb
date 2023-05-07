<?php

namespace App\Controller;
use App\Entity\Logement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
class PostItemFormController extends AbstractController
{
    private ObjectManager $manager;
    private ObjectRepository $repository;
    public function  __construct(private ManagerRegistry $doctrine)
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Logement::class);
    }

    #[Route('/postItemForm', name: 'app_post_item_form')]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
             $logement =new logement();
            dump($_POST);
            $logement->setTypeLogement($_POST['typeLogement']);

            $logement->setTypeEspace("Espace commun");

            $logement->setNumLogement(5);
            $logement->setRue("dcd");
            $logement->setPays("ed");
            $logement->setVille("mm");

            $logement->setNbrChambres(4);
            $logement->setNbrLits(2);
            $logement->setNbrSdb(2);
            $logement->setEquipements($_POST['equipement']);
            $logement->addImagesLogement();

            $logement->setTitre("ee");
            $logement->setDescription("e");
            $logement->setPrixNuité("12.00") ;


            $logement->setIdCompte();


            $this->manager->persist($logement);
            $this->manager->flush();

        }

        return $this->render('post_item_form/index.html.twig', [
            'controller_name' => 'PostItemFormController',
        ]);
    }
}
