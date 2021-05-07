<?php

namespace App\Controller;

use App\Entity\Race;
use App\Form\RaceType;
use App\Entity\Character;
use App\Entity\SavingThrow;
use App\Entity\Skill;
use App\Entity\Spell;
use App\Entity\Statistics;
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

/**
     * @Route("/character", name="character")
     */
class CharacterController extends AbstractController
{
    
    /**
     * @Route("/add", name="add", methods={"POST"},)
     */
    public function add(Request $request): Response
    // pour l'user :  $request->cookies->get('PHPSESSID');
    {

        $class = new CharacterClass();

        // Create a new form Class 
        $sentData = json_decode($request->getContent(), true);
        $class->setName($sentData["ClassProperty"]["name"]);
        $class->setInformations($sentData["ClassProperty"]["informations"]);


        $race = new Race();

        // Create a new form Race 
        $sentData = json_decode($request->getContent(), true);
        $race->setName($sentData["races"]["name"]);
        $race->setInformations($sentData["races"]["informations"]);

        // Create a new stats 
        $stats = new Statistics();
        
        // Create a new form Stats 
        $formStat = $this->createForm(StatisticsType::class, $stats, ['csrf_protection' => false]);
        $sentDataStats = json_decode($request->getContent(), true); 
        $formStat->submit($sentDataStats);

         // Create a new stats 
        $caracteristic = new Caracteristic();
        
         // Create a new form Stats 
        $form = $this->createForm(CaracteristicType::class, $caracteristic, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 
        $form->submit($sentData);

        // Create a new Spell 
        $spell = new Spell();

         // Create a new form spell 
        $formStat = $this->createForm(SpellType::class, $spell, ['csrf_protection' => false]);
        $sentDataStats = json_decode($request->getContent(), true); 
        $formStat->submit($sentDataStats);

        // Create a new SavingThrows 
        $skill = new SavingThrow();

         // Create a new form Skill 
        $formStat = $this->createForm(SkillType::class, $skill, ['csrf_protection' => false]);
        $sentDataStats = json_decode($request->getContent(), true); 
        $formStat->submit($sentDataStats);

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
        $character->setStatistics($stats);
        $character->setRace($race);
        $character->setSpell($spell);
        $character->setSkill($skill);
        $character->setClass($class);
        
        
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
        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        $form->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->json([
                $character, 200, [],
            ]);
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
                'groups' => [
                'read_character', 
            ],
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





}