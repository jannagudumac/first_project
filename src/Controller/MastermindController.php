<?php

namespace App\Controller; //to avoid naming conflicts, namespace is like package in java

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // the basic class of controller
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Mastermind;
final class MastermindController extends AbstractController
{
    #[Route('/master', name: 'app_master')] //the name is useful for dynamic routing, for example, in twig template, we can use {{ path('app_first') }} to get the url of this route
    public function master(Request $request): Response
    {
        $session = $request-> getSession();
        //get game from session
        $game = $session->get('mastermind'); //tryng to get session by key 'mastermind'
        if ($game === null) { //if game doesn't exist 
            $game = new Mastermind(); //create a new one
            $session->set('mastermind', $game); // ключ в session: "mastermind", значение: объект из переменной $game
            //session
            //     └── mastermind → объект Mastermind
        }
        //get code from form
        $code = $request->request->get('code'); 
        //1st request is the HTTP object, the 2nd request is the object's property, where symfony keeps POST parameters of the form
        //test the code
        if ($code !== null) {
            $game->test($code);
            $session->set('mastermind', $game);
        }
    return $this->render('mastermind/mastermind.twig', //starts counting from the templates folder
    // take twig template from this source, render and return the html as http response
    [
        'code' => $code,
        'essais' => $game->getEssais(),
        'fini'=> $game->isFini(),
    ]);  
    }
}

