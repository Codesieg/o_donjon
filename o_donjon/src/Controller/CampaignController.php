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
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(CampaignRepository $campaignRepository): Response
    {
        $campaigns = $campaignRepository->findAll();
        return $this->json($campaigns, 200, [], [
            'groups' => ['read_campaign','browse_campaign'],
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Campaign $campaign): Response
    {
        return $this->json($campaign, 200, [], [
            'groups' => ['read_campaign','browse_campaign'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Campaign $campaign): Response
    {
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        $sentData = json_decode($request->getContent(), true);
        
        $form->submit($sentData);

        if ($form->isValid()) {
           
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
        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        $sentData = json_decode($request->getcontent(), true);
        $form->submit($sentData);
        $form->getData();

        if ($form->isValid()) {
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

    
}
