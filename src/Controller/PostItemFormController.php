<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostItemFormController extends AbstractController
{
    #[Route('/postItemForm', name: 'app_post_item_form')]
    public function index(): Response
    {
        return $this->render('post_item_form/index.html.twig', [
            'controller_name' => 'PostItemFormController',
        ]);
    }
}
