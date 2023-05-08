<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ImagesLogement;

class ImageController extends AbstractController
{
    private ObjectManager $manager;
    private ObjectRepository $repository;

    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->manager->getRepository(ImagesLogement::class);
    }

    #[Route('/image', name: 'app_image')]
    public function index(): Response
    {
        $images = $this->repository->findAll();
        foreach ($images as $image) {
            $image->setData(base64_encode(stream_get_contents($image->getData())));
        }

        return $this->render('image/index.html.twig', array('images' => $images));
    }
}