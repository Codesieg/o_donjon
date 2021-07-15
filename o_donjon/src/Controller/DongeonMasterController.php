<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use App\Controller\CharacterController;
use App\Repository\CharacterRepository;
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
    public function browse(CampaignRepository $campaignRepository): Response
    {

        // on récupère l'Id de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        return $this->render('dongeon_master/index.html.twig', [
            // on récupère les campagnes dont l'utilisateur est le DM
            'campaigns' => $campaignRepository->findBy(array('owner' => $userId)),
        ]);
    }

        /**
     * @Route("/campaign/{id}", name="read_campaign", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Campaign $campaign): Response
    {
        return $this->render('dongeon_master/read.html.twig', [
            'campaign' => $campaign,
        ]);
    }

        /**
     * @Route("/campaign/add", name="add_campaign")
     */
    public function add(Request $request): Response
    {

        // on récupère l'Id de l'utilisateur connecté
        $ownerId = $this->getUser();
        
        // New campaign creation
        $campaign = new Campaign();

        // Form creation linked to new user 
        $form = $this->createForm(CampaignType::class, $campaign);

        // Form handling with request
        $form->handleRequest($request);
        // dd($form->isValid());

        // If form submitting and validating Ok, then database update 
        if ($form->isSubmitted() && $form->isValid()) {
            
              // on associe l'utilisateur à la campagne en tant que DM
            $campaign->setOwner($ownerId);

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
    /**
     * @Route("/campaign/edit/{id}", name="edit_campaign",  methods={"GET", "POST"}, requirements={"id" : "\d+"})
     */
    public function edit(Campaign $campaign, Request $request): Response
    {

        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner de la campagne
        $campaignOwnerId = $campaign->getOwner()->getId();

        $editingCampaign = $campaign->getId();
        // dd($editingCampaign);

         // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $campaignOwnerId) {
            return  $this->addFlash('danger', 'Vous n\'étes pas autorisé à éditer la campagne ' . $campaign->getName() . ' !');;
        }
        
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On met à jour la date de dernière modification
            $campaign->setUpdatedAt(new \DateTime());

             // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La campagne ' . $campaign->getName() . ' a bien été <strong>modifié</strong>');

            return $this->redirectToRoute('dm_read_campaign', ['id' => $editingCampaign]);
        }

        // on retourne la campagne modifiée
        return $this->render('dongeon_master/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/campaign/delete/{id}", name="delete_campaign", methods={"GET"}, requirements={"id" : "\d+"} )
     */
    public function delete(Campaign $campaign, CharacterRepository $characterRepository, CharacterController $characterController): Response
    {
         // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

          // on récupére l'ID du owner de la campagne
        $campaignOwnerId = $campaign->getOwner()->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $campaignOwnerId) {
            return  $this->addFlash('danger', 'Vous n\'étes pas autorisé à supprimer la campagne ' . $campaign->getName() . ' !');;
        }

        $campaignId = $campaign->getId();

        // on récupère les personnages de la campagne
        $characters = $characterRepository->findBy(array('campaign' => $campaignId));

        foreach ($characters as $character) {
            
            $characterController->resetCampaign($character);
        }
    
        // on demande à la BDD de supprimer la campagne
        $em = $this->getDoctrine()->getManager();
        $em->remove($campaign);
        $em->flush();
        
        $this->addFlash('success', 'La campagne ' . $campaign->getName() . ' a bien été supprimé');

        return $this->redirectToRoute('dm_home');
    }

        /**
     * @Route("/campaign/archived/{id}", name="archived_campaign", methods={"GET"}, requirements={"id" : "\d+"} )
     */
    public function archived(Campaign $campaign): Response
    {
        $em = $this->getDoctrine()->getManager();
        $campaign->setIsArchived(true);
        $em->flush();
        
        $this->addFlash('success', 'La campagne ' . $campaign->getName() . ' a bien été archivée');

        return $this->redirectToRoute('dm_home');
    }

        /**
     * @Route("/campaign/browse/archived/", name="browse_archived_campaign", methods={"GET"}, requirements={"id" : "\d+"})
     */
    public function BrowseArchived(CampaignRepository $campaignRepository): Response
    {

     // on récupère l'Id de l'utilisateur connecté
    $userId = $this->getUser()->getId();

    return $this->render('dongeon_master/index.html.twig', [
         // on récupère les campagnes dont l'utilisateur est le DM
        'campaigns' => $campaignRepository->findByIsArchived($userId),
    ]);

    }
}
