<?php

namespace App\Controller;

use App\service\PremierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(SessionInterface $session): Response
    {
        if ($session->has('nbVisite')) {
            $nbVisite = $session->get('nbVisite');
            $nbVisite++;
            $WelcomingMessage="c'est votre $nbVisite éme visite";
            $nbVisite = $session->set('nbVisite',$nbVisite);
        }
        else
        {
            $nbVisite = $session->set('nbVisite',1);
            $WelcomingMessage="bienvenue c'est votre premiere visite";
        }
        $premierService= new PremierService();
       return $this->render('first/index.html.twig',[
                'message'=> $premierService->sayHello()
            ]

        );

    }
}
