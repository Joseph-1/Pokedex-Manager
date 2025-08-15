<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/{reactRouting}', name: 'app_react', requirements: ['reactRouting' => '^(?!api).*$'])]
    public function index(): Response
    {
        // Renvoie le template principal qui contient <div id="root"></div>
        return $this->render('base.html.twig');
    }
}
