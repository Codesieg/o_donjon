<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
* @Route("/player", name="player")
*/
class PlayerSpaceController extends AbstractController
{
    /**
     * @Route("/player", name="player")
     */
    public function index(): Response
    {
        $session = $this->get('session');

        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerSpaceController',
        ]);
    }
}
