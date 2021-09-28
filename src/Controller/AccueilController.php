<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(GameRepository $gr): Response
    {
        $game1 = $gr->room1();
        $game2 = $gr->room2();
        $game3 = $gr->room3();
        $game4 = $gr->room4();

        //dd($id);
        //renvoi le jeu correspondant à la salle 1
        return $this->render('accueil/index.html.twig', [
            'game1' => $game1,
            'game2' => $game2,
            'game3' => $game3,
            'game4' => $game4

        ]);
    }

    #[Route('/', name: 'accueil-form', methods: ['GET', 'POST'])]
    public function form(Request $request)
    {
        $surname = $request->request->get('surname');
        $firstname = $request->request->get('firstname');
        $telephone = $request->request->get('telephone');
        $mail = $request->request->get('mail');
        $message = $request->request->get('message');
    }
    
} 
