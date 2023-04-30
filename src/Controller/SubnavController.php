<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubnavController extends AbstractController
{
    #[Route('/subnav', name: 'app_subnav')]
    public function index(): Response
    {
        return $this->render('subnav/index.html.twig', [
            'controller_name' => 'SubnavController',
        ]);
    }
}
