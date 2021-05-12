<?php

namespace App\Controller;

use App\Entity\Race;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Spell;
use App\Form\RaceType;
use App\Form\SkillType;
use App\Form\SpellType;
use App\Entity\Campaign;
use App\Entity\Character;
use App\Entity\Statistics;
use App\Entity\SavingThrow;
use App\Form\CharacterType;
use App\Form\StatisticsType;
use App\Entity\Caracteristic;
use App\Form\SavingThrowType;
use App\Entity\CharacterClass;
use App\Form\CaracteristicType;
use App\Form\CharacterClassType;
use App\Repository\CampaignRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
     * @Route("/character", name="character")
     * 
     */
class CharacterController extends AbstractController
{
    
    /**
     * @Route("/add", name="add", methods={"POST"},)
     */
    public function add(Request $request): Response
    // pour l'user :  $request->cookies->get('PHPSESSID');
    {

        $user = $this->getUser();
        
        $character = new Race();
        // Create a new forms character  
        $form = $this->createForm(RaceType::class, $character, [
            'csrf_protection' => false,
        ]);  
        
        $character = new CharacterClass();
        // Create a new forms character  
        $form = $this->createForm(CharacterClassType::class, $character, [
            'csrf_protection' => false,
        ]);  
        
        $character = new Statistics();
        // Create a new forms character  
        $form = $this->createForm(StatisticsType::class, $character, [
            'csrf_protection' => false,
            ]);  
            
            
        $character = new Spell();
        // Create a new forms character  
        $form = $this->createForm(SpellType::class, $character, [
            'csrf_protection' => false,
            ]);  
            
        
        $character = new SavingThrow();
        // Create a new forms character  
        $form = $this->createForm(SavingThrowType::class, $character, [
            'csrf_protection' => false,
        ]);  

        $character = new Skill();
        // Create a new forms character  
        $form = $this->createForm(SkillType::class, $character, [
            'csrf_protection' => false,
        ]);  


        // Create a new character 
        $character = new Character();
        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        $character->setUser($user);
        
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();
            
            return $this->json($character,  201, [], [
                'groups' => ['read_character'],
            ]);
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
        
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT"},)
     */
    public function edit(Request $request, Character $character): Response
    {
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner du personnage
        $characterOwnerId = $character->getUser()->getId();

        // on recupère l'ID du owner de la campagne du personnage (si il y en a)
        if ($character->getCampaign()) {
            $campagneOwnerId = $character->getCampaign()->getOwner()->getId();
        }

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $characterOwnerId && $userId != $campagneOwnerId) {
            return $this->json('wrong user ID', 401);
        }

        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        $form->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->json(
                $character, 200, [], [
                    'groups' => ['read_character'],
                ]
            );;
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
        
    }

    /**
     * @Route("/browse", name="browse", methods={"GET"})
     */
    public function browse(CharacterRepository $characters): Response
    {
        $Allcharacters = $characters->findAll();
        return $this->json(
            $Allcharacters, 200, [], [
                'groups' => ['browse_character'],
            ]
        );
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Character $character): Response
    {
        
        return $this->json(
            $character, 200, [], [
                'groups' => ['read_character'],
            ]
        );
    }

    
    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Character $character): Response
    {
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner du personnage
        $requestId = $character->getUser()->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $requestId) {
            return $this->json('wrong user ID', 401);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($character);
        $em->flush();

        return $this->json(null, 204);
    }

    /************************************ADVANCED METHODS*************************************/

    /**
     * ASSIGN A CAMPAIGN TO A CHARACTER
     * 
     * @Route("/{id}/campaign/{campaign_id}", name="edit_campaign", methods={"PATCH"})
     * @ParamConverter("character", options={"mapping": {"id": "id"}})
     * @ParamConverter("campaign", options={"mapping": {"campaign_id": "id"}})
     * 
     */
    public function editCampaign(Request $request, Character $character, Campaign $campaign): Response
    {
        // Identify campaign Id
        $campaignId = $campaign->getId();

        // Associate form and character 
        $form = $this->createForm(CharacterType::class, $character, [
            'csrf_protection' => false
        ]);
        
        // Transform request json content
        $sentData = json_decode($request->getContent(), true);
        
        // Assign new campaign Id to the request character  
        $sentData['campaign'] = $campaignId;

        // Submit updated data
        $form->submit($sentData);

        // Check and responses
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->json(
                $character, 200, [], [
                    'groups' => ['read_character'],
                ]
            );
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
        
    }



}