<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile_index')]
    #[IsGranted("ROLE_USER")]
    public function index(): Response
    {
        $now = new \DateTime();
        return $this->render('profile/index.html.twig',[
            "now" => $now
        ]
        );
    }
}
