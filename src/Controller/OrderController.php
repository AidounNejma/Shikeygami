<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'order_index', methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->orderDesc(),
        ]);
    }

    #[Route('/new', name: 'order_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request): Response
    {
        $order = new Order();
        $order->setDateOfOrder(new \DateTime);
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            
            $this->addFlash('success', 'Commande créée avec succès !');
            return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->getErrors()) {
            $this->addFlash('warning', 'Vérifiez que tous les champs soient correctement remplis !');
        }
        return $this->renderForm('order/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'order_show', methods: ['GET'])]
    #[IsGranted("ROLE_USER")]
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}/edit', name: 'order_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Commande modifiée avec succès !');
            return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->getErrors()) {
            $this->addFlash('warning', 'Vérifiez que tous les champs soient correctement remplis !');
        }
        
        return $this->renderForm('order/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order): Response
    {
        if(($order->getUser() == $this->getUser()) || ($this->getUser() == "ROLE_ADMIN")) // si l'utilisateur est le titulaire de l'order (c'est sa réservation) ou si l'utilisateur est un admin
        {
            $order->setCalendar(Null); // on reset le calendar a null pour pouvoir reserver a nouveau cet horaire
            if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($order);
                $entityManager->flush();
            }
        }
        else
        {
            $this->addFlash('warning', 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
        if($this->isGranted("ROLE_ADMIN") )
        {
            return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
        }
        else
        {
            return $this->redirectToRoute('profile_index', [], Response::HTTP_SEE_OTHER);
        }
        
    }

    // #[Route('/order/add/{id}', name: 'order_make',)]
    // #[IsGranted("ROLE_USER")]
    // public function ajouter(EntityManagerInterface $em, Request $request, Calendar $calendar)
    // {
    //     if ($calendar->getBooked() == NULL) {
    //         $game = $calendar->getGame(); // on recupere le jeu correspondant au calendrier
    //         $order = new Order; // on créer une nouvelle reservation

    //         $quantity = $request->query->get("playerQuantity"); // on recupere le nombre de joueur indiqué par l'utilisateur dans le form

    //         $pricePerPerson = $game->getPricePerPerson(); // on recupere le prix par personne du jeu
    //         $totalPrice = $quantity * $pricePerPerson; // on calcul le prix total par rapport au nombre de joueur indiqué
    //         // dans le cas d'une reduction, rajouter une condition et un recalcul du prix total
    //         $order->setUser($this->getUser()); // recuperation de l'utilisateur connecté et attribution à la nouvelle réservation
    //         $order->setDateOfOrder(new \DateTime()); // definition d'une nouvelle date (aujourdhui) attribuée a la nouvell réservation
    //         $order->setTotalPrice($totalPrice); // attribution du prix total
    //         $order->setPaymentStatus(0);    // attribution du status de paiement à 0 => "en attente"
    //         $order->setPlayerQuantity($quantity); // attribution du nombre de joueur indiqué par l'utilisateur

    //         $calendar->setBooked($order); // on associe la réservation au calendrier (lien entre les 2 ids pour faire la jointure)
    //         $order->setCalendar($calendar); // vis versa pour etre sur

    //         $em->persist($order);   
    //         $em->flush(); // ajout de l'order à la bdd
    //         return $this->redirectToRoute("profile_index"); //redirection vers le profil en cas de succès
    //     }
    //     else{
    //         return $this->redirectToRoute("calendar_index"); // redirection vers la liste des calendrier en cas d'echec
    //     }
    // }
}
