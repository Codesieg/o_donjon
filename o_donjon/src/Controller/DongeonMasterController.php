<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DongeonMasterController extends AbstractController
{
    /**
     * @Route("/dm", name="dongeon_master")
     */
    public function index(): Response
    {
        return $this->render('dongeon_master/index.html.twig', [
            'controller_name' => 'DongeonMasterController',
        ]);
    }
}
