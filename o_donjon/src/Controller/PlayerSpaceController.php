<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\CampaignRepository;
use App\Repository\CharacterRepository;

/**
* @Route("/player", name="player_")
*/
class PlayerSpaceController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function index(CharacterRepository $characterRepository, CampaignRepository $campaignRepository): Response
    {
        // on récupère l'id de l'utilisateur
        $userId = $this->getUser()->getId();

        // on récupère les personnages associés à l'utilisateur
        $characters = $characterRepository->findByUser($userId);

        // on récupère les personnages associés à l'utilisateur
        $campaigns = $campaignRepository->findByUser($userId);
        
        return $this->render('player/home.html.twig', [
            'characters' => $characters,
            'campaigns' => $campaigns,
        ]);
    }
}
