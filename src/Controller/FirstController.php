<?php

namespace App\Controller; //to avoid naming conflicts, namespace is like package in java

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // the basic class of controller
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
}
