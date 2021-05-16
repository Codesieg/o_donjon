<?php

namespace App\Controller;

use \DateTimeInterface;
use App\Entity\Campaign;
use App\Entity\Story;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*********************BREAD***************************************************/

/**
 * @Route("/campaign", name="campaign_")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/dm", name="browse_dm", methods={"GET"})
     */
    public function browseDm(CampaignRepository $campaignRepository): Response
    {

        $userId = $this->getUser()->getId();
        $campaigns = $campaignRepository->findBy(array('owner' => $userId));
        return $this->json($campaigns, 200, [], [
            'groups' => ['browse_campaign'],
        ]);
    }

    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(CampaignRepository $campaignRepository): Response
    {
        $userId = $this->getUser()->getId();
        $campaigns = $campaignRepository->findByUser($userId);
        return $this->json($campaigns, 200, [], [
            'groups' => ['browse_campaign'],
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Campaign $campaign): Response
    {
        return $this->json($campaign, 200, [], [
            'groups' => ['read_campaign', 'count_characters', 'count_npcs', 'count_stories', 'count_maps'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Campaign $campaign): Response
    {   

        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner de la campagne
        $campaignId = $campaign->getOwner()->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $campaignId) {
            return $this->json('wrong user ID', 401);
        }

        $owner = $this->getUser();
        
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {
            
            $campaign->setOwner($owner);
            $this->getDoctrine()->getManager()->flush();
           
            return $this->json($campaign, 200, [], [
                'groups' => ['read_campaign'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $owner = $this->getUser();

        $campaign = new Campaign();
    
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        $sentData = json_decode($request->getcontent(), true);
        $form->submit($sentData);
        // $form->getData();
        // dd($form);


        if ($form->isValid()) {
            $campaign->setOwner($owner);
            $em = $this->getDoctrine()->getManager();
            $em->persist($campaign);
            $em->flush();

            return $this->json($campaign, 201, [], [
                'groups' => ['read_campaign'],
            ]);
        } else {
            $errors = $form->getErrors(true, false);
            $errorString = (string) $errors;
            return $this->json($errorString, 400);
        }     
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Campaign $campaign): Response
    {
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner de la campagne
        $campaignId = $campaign->getOwner()->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $campaignId) {
            return $this->json('wrong user ID', 401);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($campaign);
        $em->flush();

        return $this->json(null, 204);
    }

    /*********************ADVANCED-REQUESTS***************************************************/

    /**
    * GET ALL STORIES OF A CAMPAIGN
    *
     * @Route("/{id}/story", name="stories_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseStories(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_stories'],
        ]);
    }

    /**
    * GET ALL MAPS OF A CAMPAIGN
    *
     * @Route("/{id}/map", name="maps_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseMaps(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_maps'],
        ]);
    }

    /**
    * GET ALL NPC OF A CAMPAIGN
    *
     * @Route("/{id}/npc", name="npc_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseNpc(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_npc'],
        ]);
    }

    /**
    * GET ALL CHARACTERS OF A CAMPAIGN
    *
     * @Route("/{id}/character", name="character_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseCharacter(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_character'],
        ]);
    }


    /**
    * READ WITH ASSOCIATED STATS (NB OF STORIES,..) => remplacera read ?
    *
     * @Route("/{id}/stats", name="stats_read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function readStats(Campaign $campaign): Response
    {       
        return $this->json($campaign, 200, [], [
            'groups' => ['read_campaign', 'count_characters', 'count_npcs', 'count_stories', 'count_maps'],
        ]);
    }


    
}
