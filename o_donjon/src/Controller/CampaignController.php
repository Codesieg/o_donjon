<?php

namespace App\Controller;

use \DateTimeInterface;
use App\Entity\Campaign;
use App\Entity\Story;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use OpenApi\Annotations as OA;
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
     * @OA\Get(
     *      path="/campaign/dm",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of campaigns as the DM",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignList"))
     *      )
     * )
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
     * @OA\Get(
     *      path="/campaign",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of campaigns as a player",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignList"))
     *      )
     * )
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
     * @OA\Get(
     *      path="/campaign/{id}",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaign"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Put(
     *      path="/campaign/{id}",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/campaign"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaign"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Post(
     *      path="/campaign",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/campaign"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaign"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Delete(
     *      path="/campaign/{id}",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
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
     * @OA\Get(
     *      path="/campaign/{id}/story",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="List of stories of a campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignStories"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Get(
     *      path="/campaign/{id}/map",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="List of maps of a campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignMaps"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Get(
     *      path="/campaign/{id}/npc",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="List of NPCs of a campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignNPCs"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
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
     * @OA\Get(
     *      path="/campaign/{id}/character",
     *      tags={"Campaign"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="List of Characters of a campaign",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/campaignCharacters"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function browseCharacter(Campaign $campaign): Response
    {   
        // on retourne les personnages associés à la campagne
        return $this->json($campaign, 200, [], [
            'groups' => ['browse_campaign_character'],
        ]);
    }

}
