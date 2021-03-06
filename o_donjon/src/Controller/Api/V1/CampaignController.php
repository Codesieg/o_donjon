<?php

namespace App\Controller\Api\V1;


use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Api\V1\CharacterController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/*********************BREAD***************************************************/

/**
 * @Route("/api/campaign", name="api_campaign_")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/dm", name="browse_dm", methods={"GET"})
     */
    public function browseDm(CampaignRepository $campaignRepository): Response
    {
        // on récupère l'Id de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupère les campagnes dont l'utilisateur est le DM
        $campaigns = $campaignRepository->findBy(array('owner' => $userId));

        // on retourne la liste des campagnes récupérées
        return $this->json($campaigns, 200, [], [
            'groups' => ['browse_campaign'],
        ]);
    }

    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(CampaignRepository $campaignRepository): Response
    {
        // on récupère l'Id de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupère les campagnes où l'utilisateur est enregistré comme joueur
        $campaigns = $campaignRepository->findByUser($userId);

        // on retourne la liste des campagnes récupérées
        return $this->json($campaigns, 200, [], [
            'groups' => ['browse_campaign'],
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Campaign $campaign): Response
    {
        // on retourne la campagne concernée avec le nombre de personnages, NPCs, histoires et maps associés
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

        // on récupère l'utilisateur connecté
        $owner = $this->getUser();
        
        // on créer un formulaire pour la classe campaign
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);
        // on envoie les informations dans le formulaire
        $form->submit($sentData);
        
        // si les données sont valides
        if ($form->isValid()) {
            
            // on associe l'utilisateur à la campagne en tant que DM
            $campaign->setOwner($owner);

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();
            
            // on retourne la campagne modifiée
            return $this->json($campaign, 200, [], [
                'groups' => ['read_campaign', 'count_characters', 'count_npcs', 'count_stories', 'count_maps'],
            ]);
        }

        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(Request $request): Response
    {   
        // on récupère l'utilisateur connecté
        $owner = $this->getUser();

        // on créer un objet campagne
        $campaign = new Campaign();
        
        // on créer un formulaire pour la classe campaign
        $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false,
        ]);
        
        // on récupère les informations de la requête
        $sentData = json_decode($request->getcontent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {

            // on associe l'utilisateur à la campagne en tant que DM
            $campaign->setOwner($owner);

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($campaign);
            $em->flush();

            // on retourne la campagne créée
            return $this->json($campaign, 201, [], [
                'groups' => ['read_campaign', 'count_characters', 'count_npcs', 'count_stories', 'count_maps'],
            ]);

        // si le formulaire n'est pas valide on retourne les erreurs
        } else {
            $errors = $form->getErrors(true, false);
            $errorString = (string) $errors;
            return $this->json($errorString, 400);
        }     
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Campaign $campaign, CharacterRepository $characterRepository, CharacterController $characterController): Response
    {
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner de la campagne
        $campaignOwnerId = $campaign->getOwner()->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $campaignOwnerId) {
            return $this->json('wrong user ID', 401);
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

        // on retourne un code 204 si la campagne est bien supprimée
        return $this->json(null, 204);
    }

    /*********************ADVANCED-REQUESTS***************************************************/

    /* GET ALL STORIES OF A CAMPAIGN */

    /**
     * @Route("/{id}/story", name="stories_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseStories(Campaign $campaign): Response
    {
        // on retourne les histoires associées à la campagne
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_stories'],
        ]);
    }

    /* GET ALL MAPS OF A CAMPAIGN */

    /**
     * @Route("/{id}/map", name="maps_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseMaps(Campaign $campaign): Response
    {    
        // on retourne les cartes associées à la campagne
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_maps'],
        ]);
    }

    /* GET ALL NPCS OF A CAMPAIGN */

    /**
     * @Route("/{id}/npc", name="npc_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseNpc(Campaign $campaign): Response
    {   
        // on retourne les NPCs associés à la campagne
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_npc'],
        ]);
    }

    /* GET ALL CHARACTERS OF A CAMPAIGN */

    /**
     * @Route("/{id}/character", name="character_list", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function browseCharacter(Campaign $campaign): Response
    {   
        // on retourne les personnages associés à la campagne
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_character'],
        ]);
    }

}
