<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game')]
class GameController extends AbstractController
{
    #[Route('/', name: 'game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    #[Route('/game-list', name: 'game_list', methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function backList(GameRepository $gameRepository)
    {
        return $this->render('game/back.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'game_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, GameRepository $gr): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->get('room')->getData();
            
            if ($fichier = $form->get("imageUrl")->getData()) {
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);

                $nomFichier = str_replace(" ", "_", $nomFichier);

                $nomFichier .= uniqid() . "." . $fichier->guessExtension();


                $fichier->move($this->getParameter("dossier_images"), $nomFichier);

                $game->setImageUrl($nomFichier);
            }
            if ($fichier2 = $form->get("imageUrl2")->getData()) {
                $nomFichier2 = pathinfo($fichier2->getClientOriginalName(), PATHINFO_FILENAME);

                $nomFichier2 = str_replace(" ", "_", $nomFichier2);

                $nomFichier2 .= uniqid() . "." . $fichier2->guessExtension();

                $fichier2->move($this->getParameter("dossier_images"), $nomFichier2);

                $game->setImageUrl2($nomFichier2);
            }
            if ($fichier3 = $form->get("imageUrl3")->getData()) {
                $nomFichier3 = pathinfo($fichier3->getClientOriginalName(), PATHINFO_FILENAME);

                $nomFichier3 = str_replace(" ", "_", $nomFichier3);

                $nomFichier3 .= uniqid() . "." . $fichier3->guessExtension();

                $fichier3->move($this->getParameter("dossier_images"), $nomFichier3);

                $game->setImageUrl3($nomFichier3);
            }
            if ($gr->isItFree($room) != NULL) {
                $this->addFlash('warning', 'La salle choisie est déjà occupée par un autre jeu');
                return $this->renderForm('game/new.html.twig', [
                    'game' => $game,
                    'form' => $form,
                ]);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();
            $this->addFlash('success', 'Jeu créé avec succès !');


            return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->getErrors()) {
            $this->addFlash('warning', 'Vérifiez que tous les champs soient correctement remplis !');
        }
        return $this->renderForm('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/{id}/edit', name: 'game_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Game $game, GameRepository $gr): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->get('room')->getData();
            if ($fichier = $form->get("imageUrl")->getData()) {
                $chemin = $game->getImageUrl();
                $cheminComplet = $this->getParameter("dossier_images") . $chemin;
                if (file_exists($cheminComplet)) {
                    unlink($cheminComplet);
                }
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= uniqid() . "." . $fichier->guessExtension();
                $fichier->move($this->getParameter("dossier_images"), $nomFichier);

                $game->setImageUrl($nomFichier);
            }
            if ($fichier2 = $form->get("imageUrl2")->getData()) {
                $chemin = $game->getImageUrl2();
                $cheminComplet = $this->getParameter("dossier_images") . $chemin;
                if (file_exists($cheminComplet)) {
                    unlink($cheminComplet);
                }
                $nomFichier2 = pathinfo($fichier2->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier2 = str_replace(" ", "_", $nomFichier2);
                $nomFichier2 .= uniqid() . "." . $fichier2->guessExtension();
                $fichier2->move($this->getParameter("dossier_images"), $nomFichier2);

                $game->setImageUrl2($nomFichier2);
            }
            if ($fichier3 = $form->get("imageUrl3")->getData()) {
                $chemin = $game->getImageUrl3();
                $cheminComplet = $this->getParameter("dossier_images") . $chemin;
                if (file_exists($cheminComplet)) {
                    unlink($cheminComplet);
                }
                $nomFichier3 = pathinfo($fichier3->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier3 = str_replace(" ", "_", $nomFichier3);
                $nomFichier3 .= uniqid() . "." . $fichier3->guessExtension();
                $fichier3->move($this->getParameter("dossier_images"), $nomFichier3);

                $game->setImageUrl3($nomFichier3);
            }
            if ($gr->isItFree($room) != NULL) {
                $this->addFlash('warning', 'La salle choisie est déjà occupée par un autre jeu');
                return $this->renderForm('game/new.html.twig', [
                    'game' => $game,
                    'form' => $form,
                ]);
            }
            $this->addFlash('success', 'Jeu modifié avec succès !');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($form->isSubmitted() && $form->getErrors()) {
            $this->addFlash('warning', 'Vérifiez que tous les champs soient correctement remplis !');
        }

        return $this->renderForm('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'game_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
    }
}
