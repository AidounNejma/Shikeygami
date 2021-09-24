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
    public function new(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($fichier = $form->get("imageUrl")->getData())
            { // si le formulaire renvoi un fichier
                //on recupere le nom du fichier qui à été téléversé
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                //on remplace les espaces par des _
                $nomFichier = str_replace(" ", "_", $nomFichier);

                // on ajoute un string au nom du fichier pour éviter les doublons et l'extension du fichier
                $nomFichier .= uniqid() . "." . $fichier->guessExtension();

                // on copie le fichier uploadé dans un dossier du dossier 'public' avec le nouveau nom de fichier
                $fichier->move($this->getParameter("dossier_images"), $nomFichier);

                // on modifie l'entité game
                $game->setImageUrl($nomFichier);
            }
            if ($fichier2 = $form->get("imageUrl2")->getData())
            { // si le formulaire renvoi un fichier
                //on recupere le nom du fichier qui à été téléversé
                $nomFichier2 = pathinfo($fichier2->getClientOriginalName(), PATHINFO_FILENAME);
                //on remplace les espaces par des _
                $nomFichier2 = str_replace(" ", "_", $nomFichier2);

                // on ajoute un string au nom du fichier pour éviter les doublons et l'extension du fichier
                $nomFichier2 .= uniqid() . "." . $fichier2->guessExtension();

                // on copie le fichier uploadé dans un dossier du dossier 'public' avec le nouveau nom de fichier
                $fichier2->move($this->getParameter("dossier_images"), $nomFichier2);

                // on modifie l'entité game
                $game->setImageUrl2($nomFichier2);
            }
            if ($fichier3 = $form->get("imageUrl3")->getData())
            { // si le formulaire renvoi un fichier
                //on recupere le nom du fichier qui à été téléversé
                $nomFichier3 = pathinfo($fichier3->getClientOriginalName(), PATHINFO_FILENAME);
                //on remplace les espaces par des _
                $nomFichier3 = str_replace(" ", "_", $nomFichier3);

                // on ajoute un string au nom du fichier pour éviter les doublons et l'extension du fichier
                $nomFichier3 .= uniqid() . "." . $fichier3->guessExtension();

                // on copie le fichier uploadé dans un dossier du dossier 'public' avec le nouveau nom de fichier
                $fichier3->move($this->getParameter("dossier_images"), $nomFichier3);

                // on modifie l'entité game
                $game->setImageUrl3($nomFichier3);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();
            $this->addFlash('success', 'Jeu créé avec succès !');


            return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
        }
        if($form->isSubmitted() && $form->getErrors()){
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
    public function edit(Request $request, Game $game): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($fichier = $form->get("imageUrl")->getData())
            { // si le formulaire renvoi un fichier
                //on recupere le nom du fichier dans la bdd
                    $chemin = $game->getImageUrl();
                    $cheminComplet = $this->getParameter("dossier_images") . $chemin;
                    if(file_exists($cheminComplet)){ // si le fichier avec le chemin nindiqué existe
                        unlink($cheminComplet);
                    }
                    
                //on recupere le nom du fichier qui à été téléversé
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                //on remplace les espaces par des _
                $nomFichier = str_replace(" ", "_", $nomFichier);

                // on ajoute un string au nom du fichier pour éviter les doublons et l'extension du fichier
                $nomFichier .= uniqid() . "." . $fichier->guessExtension();

                // on copie le fichier uploadé dans un dossier du dossier 'public' avec le nouveau nom de fichier
                $fichier->move($this->getParameter("dossier_images"), $nomFichier);

                // on modifie l'entité $game
                $game->setImageUrl($nomFichier);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
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
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index', [], Response::HTTP_SEE_OTHER);
    }
}
