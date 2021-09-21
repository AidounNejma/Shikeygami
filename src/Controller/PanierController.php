<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\Game;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get("panier"); // je recupere l'indice panier dans la session
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/panier/add{id}', name: 'panier_add')]
    public function ajouter(Request $request, SessionInterface $session)
    {
        $panier = $session->get("panier",[]); // le 2eme argument est la valeur retournée par 'get' si il n'y a pas de panier dans la session

        
        $session->set("panier", $panier); //j'ajoute en session un indice panier qui contient un array $panier qui est composé d'arrays pour chaque produit
            return $this->redirectToRoute("panier");
    }



}