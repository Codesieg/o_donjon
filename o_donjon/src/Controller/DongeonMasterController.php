<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Form\CampaignType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/dm", name="dm_")
     */
class DongeonMasterController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function browse(): Response
    {
        return $this->render('dongeon_master/index.html.twig', [
            'controller_name' => 'DongeonMasterController',
        ]);
    }

        /**
     * @Route("/campaigns", name="campaigns")
     */
    public function read(): Response
    {
        return $this->render('dongeon_master/read.html.twig', [
            'controller_name' => 'DongeonMasterController',
        ]);
    }

        /**
     * @Route("/campaign/add", name="add_campaign")
     */
    public function add(Request $request): Response
    {
        // dd($request);
        
        // New campaign creation
        $campaign = new Campaign();

        // Form creation linked to new user 
        $form = $this->createForm(CampaignType::class, $campaign);

        // Form handling with request
        $form->handleRequest($request);
        // dd($form->isValid());

        // If form submitting and validating Ok, then database update 
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Database update
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campaign);
            $entityManager->flush();

            $this->addFlash('success', 'Nouvelle campagne enregistrée.');

            return $this->redirectToRoute('dm_home');
        }

        // If form submitting and validation NOT Ok, then registration form display
        return $this->render('dongeon_master/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
