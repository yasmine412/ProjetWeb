<?php

namespace App\Controller;

use App\Entity\Logement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomsController extends AbstractController
{
    #[Route('/rooms', name: 'app_rooms')]
    public function index(): Response
    {
        return $this->render('rooms/index.html.twig',[]);
    }
}



