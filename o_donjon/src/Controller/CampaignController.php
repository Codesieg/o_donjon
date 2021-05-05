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
 * @Route("/campaigns", name="campaign_")
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
            'groups' => ['browse'],
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Campaign $campaign): Response
    {
        return $this->json($campaign, 200, [], [
            'groups' => ['read'],
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
                'groups' => ['read'],
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
                'groups' => ['read'],
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
    * READ WITH ASSOCIATED STATS (NB OF STORIES,..) => remplacera read ?
    *
     * @Route("/{id}/stats", name="stats_read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function statsRead(Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        
        $campaigns = $campaignRepository->findWithStats();
        
        return $this->json($campaign, 200, [], [
            'groups' => ['read'],
        ]);
    }

    /**
    * GET ALL STORIES OF A CAMPAIGN
    *
     * @Route("/{id}/story", name="stories_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function storiesList(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['storiesList'],
        ]);
    }

    /**
    * GET ALL MAPS OF A CAMPAIGN
    *
     * @Route("/{id}/map", name="maps_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function mapsList(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['mapsList'],
        ]);
    }

    /**
    * GET ALL NPC OF A CAMPAIGN
    *
     * @Route("/{id}/npc", name="npc_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function npcList(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['npcList'],
        ]);
    }

    /**
    * GET ALL CHARACTER OF A CAMPAIGN
    *
     * @Route("/{id}/character", name="character_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function characterList(Campaign $campaign): Response
    {    
        return $this->json($campaign, 200, [], [
            'groups' => ['characterList'],
        ]);
    }

    
}
