<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\Game;
use App\Entity\Order;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\stringContains;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get("panier"); // je recupere l'indice panier dans la session
        //dd($panier);
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/panier/add/{id}', name: 'panier_add',)]
    #[IsGranted("ROLE_USER")]
    public function ajouter(SessionInterface $session, Calendar $calendar, Request $request)
    {
        if ($calendar->getBooked() == NULL) {

            $panier = $session->get("panier", []); // le 2eme argument est la valeur retournée par 'get' si il n'y a pas de panier dans la session
            
            foreach($panier as $reservation)
            {
                if($calendar->getId() == $reservation["calendar"]->getId())
                {
                    //dd($reservation["calendar"]->getId());
                    return $this->redirectToRoute("panier");
                }
            }
            
            $game = $calendar->getGame();
            $playerQuantity = $request->query->get("playerQuantity");
            $pricePerPerson = $game->getPricePerPerson();
            $totalPrice = $playerQuantity * $pricePerPerson;

            $panier[] = ["calendar" => $calendar, "playerQuantity" => $playerQuantity, "totalPrice" => $totalPrice];
            // $panier[] = ["calendar" => $calendar, "order" => $order, "game" => $game];

            $session->set("panier", $panier); //j'ajoute en session un indice panier qui contient un array $panier qui est composé d'arrays pour chaque produit
        }
    
        return $this->redirectToRoute("panier");
    }
    #[Route('/panier/clear', name: 'panier_clear',)]
    public function clearSession(SessionInterface $session)
    {
        $session->remove('panier');
        $this->addFlash('success', 'Panier vidé avec succès.');
    
        return $this->redirectToRoute('panier');
    }


    #[Route('/panier/confirm/{id}', name: 'panier_confirm',)]
    #[IsGranted("ROLE_USER")]
    public function valider(EntityManagerInterface $em, Request $request, SessionInterface $session, Calendar $calendar)
    {
        $panier = $session->get("panier", []); // le 2eme argument est la valeur retournée par 'get' si il n'y a pas de panier dans la session
        

        if ($calendar->getBooked() == NULL) {
            $game = $calendar->getGame();
            $order = new Order;

            foreach($panier as $reservation)
            {
                if($calendar->getId() == $reservation["calendar"]->getId())
                {
                    $playerQuantity = $reservation["playerQuantity"]; // on recupere le nombre de joueur du jeu correspondant dans la session
                }
            }

            $pricePerPerson = $game->getPricePerPerson();
            $totalPrice = $playerQuantity * $pricePerPerson;

            $order->setUser($this->getUser());
            $order->setDateOfOrder(new \DateTime());
            $order->setTotalPrice($totalPrice);
            $order->setPaymentStatus(2);
            $order->setPlayerQuantity($playerQuantity);

            $calendar->setBooked($order);
            $order->setCalendar($calendar);

            $em->persist($order);
            $em->flush();

            foreach($panier as $indice => $reservation)
            {   
                if($calendar->getId() == $reservation["calendar"]->getId())
                {
                    //dd($reservation["calendar"]->getId());
                    sleep(5); //je simule le temps de réponse du serveur
                    unset($panier[$indice]);
                    break;
                }
            }
            $session->set("panier", $panier); //j'ajoute en session un indice panier qui contient un array $panier qui est composé d'arrays pour chaque produit
            
        }
        $this->addFlash('success', 'Paiement enregistré ! Merci pour votre réservation.');
        return $this->redirectToRoute('panier');
    }
}
