<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MangakaController extends AbstractController
{
    #[Route('/mangaka', name: 'app_mangaka')]
    public function index(): Response
    {
        return $this->render('mangaka/index.html.twig', [
            'controller_name' => 'MangakaController',
        ]);
    }
}
