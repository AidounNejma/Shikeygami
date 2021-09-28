<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    // /**
    //  * @Route("/", name="accueil")
    //  */
    // public function index(GameRepository $gr): Response
    // {
    //     $game1 = $gr->room1();
    //     $game2 = $gr->room2();
    //     $game3 = $gr->room3();
    //     $game4 = $gr->room4();

    //     //dd($id);
    //     //renvoi le jeu correspondant à la salle 1
    //     return $this->render('accueil/index.html.twig', [
    //         'game1' => $game1,
    //         'game2' => $game2,
    //         'game3' => $game3,
    //         'game4' => $game4

    //     ]);
    // }

    #[Route('/', name:'accueil', methods: ['GET', 'POST'])]
    public function form(Request $request, GameRepository $gr): Response
    {
        // $lastName = $request->request->get('lastname');
        // $firstName = $request->request->get('firstname');
        // $telephone = $request->request->get('telephone');
        // $mail = $request->request->get('mail');
        // $message = $request->request->get('message');
        $game1 = $gr->room1();
        $game2 = $gr->room2();
        $game3 = $gr->room3();
        $game4 = $gr->room4();
        
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();
            $messageClient = (new Email())
                ->from($contactForm['email'])
                ->to('contact@shikeygami.fr')
                ->subject('Mail client')
                ->text('Client : ' . 
            $contactForm['surname'] . ' ' . 
            $contactForm['firstname'] . 
            ' Message : ' .
            $contactForm['message']
            );
            $this->addFlash('success', 'Votre message a bien été envoyé à l\'équipe');


            return $this->redirectToRoute('accueil', [
                'messageClient' => $messageClient
            ], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->getErrors()){
            $this->addFlash('warning', 'Vérifiez que tous les champs du formulaire de contact soient correctement remplis !');
        } 
        
        return $this->render('accueil/index.html.twig', [
            'form' => $form->createView(),
            'game1' => $game1,
            'game2' => $game2,
            'game3' => $game3,
            'game4' => $game4
        ]);
    }
    
} 
