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
use App\Form\CampaignType;
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
        $form = $this->createForm(RaceType::class, $character, [
            'csrf_protection' => false,
        ]);  
        
        $character = new CharacterClass();
        $form = $this->createForm(CharacterClassType::class, $character, [
            'csrf_protection' => false,
        ]);  
        
        $character = new Statistics();
        $form = $this->createForm(StatisticsType::class, $character, [
            'csrf_protection' => false,
            ]);  
            
    
        $character = new Spell();
        $form = $this->createForm(SpellType::class, $character, [
            'csrf_protection' => false,
            ]);  
            
        $character = new SavingThrow();
        $form = $this->createForm(SavingThrowType::class, $character, [
            'csrf_protection' => false,
        ]);  

        $character = new Skill();  
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
     * @Route("/{id}", name="edit", methods={"PUT"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, character $character, CampaignRepository $campaignRepository): Response
    {
        // Get user from character  
        $user = $this->getUser();
        
        // Edit race 
        $raceId = $character->getRace();
        $race = $this->getDoctrine()->getManager()->getRepository(Race::class)->find($raceId);
        $form = $this->createForm(RaceType::class, $race, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit class 
        $classId = $character->getClass();
        $class = $this->getDoctrine()->getManager()->getRepository(CharacterClass::class)->find($classId);
        $form = $this->createForm(CharacterClassType::class, $class, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit caracteristics 
        $caracteristicId = $character->getCaracteristics();
        $caracteristics = $this->getDoctrine()->getManager()->getRepository(Caracteristic::class)->find($caracteristicId);
        $formStat = $this->createForm(CaracteristicType::class, $caracteristics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit stats 
        $statisticsId = $character->getStatistics();
        $statistics = $this->getDoctrine()->getManager()->getRepository(Statistics::class)->find($statisticsId);
        $form = $this->createForm(StatisticsType::class, $statistics, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit spell 
        $spellId = $character->getSpell();
        $spell = $this->getDoctrine()->getManager()->getRepository(Spell::class)->find($spellId);
        $form = $this->createForm(SpellType::class, $spell, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit savingthrowspell 
        $savingthrowspellId = $character->getSavingThrowspell();
        $savingthrowspell = $this->getDoctrine()->getManager()->getRepository(SavingThrow::class)->find($savingthrowspellId);
        $form = $this->createForm(SavingThrowType::class, $savingthrowspell, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        // Edit skill 
        $skillId = $character->getSavingThrowspell();
        $skill = $this->getDoctrine()->getManager()->getRepository(Skill::class)->find($skillId);
        $form = $this->createForm(SkillType::class, $skill, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); 

        $campaignId = $character->getCampaign();

        if ( $campaignId !== null){
            
            $test = $campaignRepository->findByUserAndByCampaign($user->getId(), $campaignId->getId());
            if (empty($test)) {
                echo "Vous n'avez pas rejoint cette campagne";
            } else {
                echo "Ok !!";
            }
            // dd($user->getId(), $campaignId->getId(), $test);
            $this->getDoctrine()->getManager()->getRepository(Campaign::class)->find($campaignId);
            $sentData = json_decode($request->getContent(), true); 
        }

        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner du personnage
        $characterOwnerId = $character->getUser()->getId();

        // on définit la valeur par défaut du propriétaire de la campagne à 0
        $campaignOwnerId = 0;

        // on recupère l'ID du owner de la campagne du personnage (si il y en a)
        if ($character->getCampaign()) {
            $campaignOwnerId = $character->getCampaign()->getOwner()->getId();
        }

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $characterOwnerId && $userId != $campaignOwnerId) {
            return $this->json('wrong user ID', 401);
        }

        // Edit a character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        // $character->setStatistics($statistics);
        $character->setUser($user);

        
        // If the form is correct persist and flush it
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(CharacterRepository $characterRepository): Response
    {
         // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // dd($userId);
        $characters = $characterRepository->findByUser($userId);
        // dd($characters);
        return $this->json(
            $characters, 200, [], [
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

}