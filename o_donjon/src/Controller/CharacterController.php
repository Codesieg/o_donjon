<?php

namespace App\Controller;

use App\Entity\Race;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Spell;
use App\Form\SkillType;
use App\Form\SpellType;
use App\Entity\Campaign;
use App\Entity\Character;
use App\Entity\Statistics;
use App\Entity\SavingThrow;
use App\Form\CharacterType;
use App\Form\StatisticsType;
use App\Entity\Caracteristic;
use App\Entity\CharacterClass;
use App\Form\CaracteristicType;
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

        $repository = $this->getDoctrine()->getRepository(User::class);
        $data_users = $repository->findOneBy(['id' => $user->getId()]);
        dd($data_users);

        // Create a new  Class 
        $class = new CharacterClass();
        $sentData = json_decode($request->getContent(), true);
        $class->setName($sentData["ClassProperty"]["name"]);
        $class->setInformations($sentData["ClassProperty"]["informations"]);

        // Create a new Race 
        $race = new Race();
        $sentData = json_decode($request->getContent(), true);
        $race->setName($sentData["races"]["name"]);
        $race->setInformations($sentData["races"]["informations"]);

        // Create a new stats 
        $statistics = new Statistics();
        // Create a new form Stats 
        $formStat = $this->createForm(StatisticsType::class, $statistics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $formStat->submit($sentData);

         // Create a new caracteristics 
        $caracteristics = new Caracteristic();
         // Create a new form caracteristics 
        $form = $this->createForm(CaracteristicType::class, $caracteristics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $form->submit($sentData);

        // Create a new Spell 
        $spell = new Spell();
         // Create a new form spell 
        $formStat = $this->createForm(SpellType::class, $spell, ['csrf_protection' => false]);
        $sentDataStats = json_decode($request->getContent(), true); 
        $formStat->submit($sentDataStats);

        // Create a new SavingThrows 
        $savingThrows  = new SavingThrow();
        // Create a new form SavingThrows 
        $sentData = json_decode($request->getContent(), true);
        $savingThrows->setStrength($sentData["savingThrowspellDone"]["strength"]);
        $savingThrows->setDexterity($sentData["savingThrowspellDone"]["dexterity"]);
        $savingThrows->setConstitution($sentData["savingThrowspellDone"]["constitution"]);
        $savingThrows->setIntelligence($sentData["savingThrowspellDone"]["intelligence"]);
        $savingThrows->setWisdom($sentData["savingThrowspellDone"]["wisdom"]);
        $savingThrows->setCharisma($sentData["savingThrowspellDone"]["charisma"]);
        
        // Create a new Skill 
        $skill = new Skill();
         // Create a new form Skill 
        $formStat = $this->createForm(SkillType::class, $skill, ['csrf_protection' => false]);
        $sentDataStats = json_decode($request->getContent(), true); 
        $formStat->submit($sentDataStats);
        
        // Create a new character 
        $character = new Character();
        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);

        // We add all property to character
        $character->setStatistics($statistics);
        $character->setRace($race);
        $character->setSpell($spell);
        $character->setSkill($skill);
        $character->setSavingThrowspell($savingThrows);
        $character->setClass($class);
        $character->setCaracteristics($caracteristics);
        $character->setUser($user);

        // If the form is correct persist and flush it
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();

            // We are returning json for the api
            return $this->json($character,  201, [], [
                'groups' => ['read_character'],
            ]);
        }
        // if the form is not correct return en error
        return $this->json($form->getErrors(true, false)->__toString(), 400);
        
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, character $character): Response
    {
        // Get user from character  
        $user = $this->getUser();

        // Edit class 
        $classId = $character->getClass(); 
        $class = $this->getDoctrine()->getManager()->getRepository(CharacterClass::class)->find($classId);

        $sentData = json_decode($request->getContent(), true); 
        $class->setName($sentData["ClassProperty"]["name"]);
        $class->setInformations($sentData["ClassProperty"]["informations"]);
        

        // Edit race 
        $raceId = $character->getRace();
        $race = $this->getDoctrine()->getManager()->getRepository(Race::class)->find($raceId);
        
        $sentData = json_decode($request->getContent(), true); 
        $race->setName($sentData["races"]["name"]);
        $race->setInformations($sentData["races"]["informations"]);


        // Edit stats 
        $statisticsId = $character->getStatistics();
        $statistics = $this->getDoctrine()->getManager()->getRepository(Statistics::class)->find($statisticsId);
        $formStat = $this->createForm(StatisticsType::class, $statistics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $formStat->submit($sentData);

        // Edit caracteristics 
        $caracteristicsId = $character->getCaracteristics();
        $caracteristics = $this->getDoctrine()->getManager()->getRepository(Caracteristic::class)->find($caracteristicsId);
        $formStat = $this->createForm(CaracteristicType::class, $caracteristics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $formStat->submit($sentData);

        // Edit spell 
        $spellId = $character->getSpell();
        $spell = $this->getDoctrine()->getManager()->getRepository(Spell::class)->find($spellId);
        $formStat = $this->createForm(SpellType::class, $spell, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $formStat->submit($sentData);

        // Edit savingthrowspell 
        $savingThrowsId = $character->getSavingThrowspell();
        $savingThrows = $this->getDoctrine()->getManager()->getRepository(SavingThrow::class)->find($savingThrowsId);
        
        $sentData = json_decode($request->getContent(), true); 
        $savingThrows->setStrength($sentData["savingThrowspellDone"]["strength"]);
        $savingThrows->setDexterity($sentData["savingThrowspellDone"]["dexterity"]);
        $savingThrows->setConstitution($sentData["savingThrowspellDone"]["constitution"]);
        $savingThrows->setIntelligence($sentData["savingThrowspellDone"]["intelligence"]);
        $savingThrows->setWisdom($sentData["savingThrowspellDone"]["wisdom"]);
        $savingThrows->setCharisma($sentData["savingThrowspellDone"]["charisma"]);
        
        // Edit a  Skill for a character
        $skillId = $character->getSkill();
        $skill = $this->getDoctrine()->getManager()->getRepository(Skill::class)->find($skillId);
        $formStat = $this->createForm(SkillType::class, $skill, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $formStat->submit($sentData);
        

        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        $character->setStatistics($statistics);
        $character->setRace($race);
        $character->setSpell($spell);
        $character->setSkill($skill);
        $character->setSavingThrowspell($savingThrows);
        $character->setClass($class);
        $character->setCaracteristics($caracteristics);
        $character->setUser($user);
        
        // If the form is correct persist and flush it
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();
            
            // We are returning json for the api
            return $this->json($character,  201, [], [
                'groups' => ['read_character'],
            ]);
        }
        // if the form is not correct return en error
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