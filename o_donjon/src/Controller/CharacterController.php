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
use OpenApi\Annotations as OA;
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
     * @Route("", name="add", methods={"POST"},)
     * @OA\Post(
     *      path="/character",
     *      tags={"Character"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/characterName"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the character",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/characterInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function add(Request $request): Response
    {
        
        // on récupère l'utilisateur connecté
        $user = $this->getUser();

        // on créer un objet Character
        $character = new Character();

        // on associe l'utilisateur au personnage
        $character->setUser($user);

        // on créer un objet Race
        $race = new Race();

        // on créer un objet CharacterClass
        $class = new CharacterClass();

        // on créer un objet Caracteristic
        $caracteristics = new Caracteristic();

        // on créer un objet Statistics
        $statistics = new Statistics();

        // on créer un objet Spell
        $spell = new Spell();

        // on créer un objet Spell
        $spell = new Spell();

        // on créer un objet SavingThrow
        $savingThrowspell = new SavingThrow();

        // on créer un objet Skill
        $skill = new Skill();

        // on associe les objets créés à l'objet character
        $character->setRace($race);
        $character->setClass($class);
        $character->setCaracteristics($caracteristics);
        $character->setStatistics($statistics);
        $character->setSpell($spell);
        $character->setSavingThrowspell($savingThrowspell);
        $character->setSkill($skill);

        // on récupère le nom saisi par l'utilisateur
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];

        // on défini ce nom comme celui du personnage
        $character->setName($name);

        // on envoie les données à la BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($character);
        $em->flush();
        
        // on retourne le personnage créé
        return $this->json($character,  201, [], [
            'groups' => ['read_character'],
        ]);


        // // on créer un objet Race
        // $character = new Race();
        // // on créer un formulaire pour la classe Race
        // $form = $this->createForm(RaceType::class, $character, [
        //     'csrf_protection' => false,
        // ]);

        // // on créer un objet CharacterClass
        // $character = new CharacterClass();
        // // on créer un formulaire pour la classe CharacterClass
        // $form = $this->createForm(CharacterClassType::class, $character, [
        //     'csrf_protection' => false,
        // ]);  
        
        // // on créer un objet Statistics
        // $character = new Statistics();
        // // on créer un formulaire pour la classe Statistics
        // $form = $this->createForm(StatisticsType::class, $character, [
        //     'csrf_protection' => false,
        //     ]);  
            
        // // on créer un objet Spell
        // $character = new Spell();
        // // on créer un formulaire pour la classe Spell
        // $form = $this->createForm(SpellType::class, $character, [
        //     'csrf_protection' => false,
        //     ]);  
        
        // // on créer un objet SavingThrow
        // $character = new SavingThrow();
        // // on créer un formulaire pour la classe SavingThrow
        // $form = $this->createForm(SavingThrowType::class, $character, [
        //     'csrf_protection' => false,
        // ]);  
        
        // // on créer un objet Skill
        // $character = new Skill();
        // // on créer un formulaire pour la classe Skill
        // $form = $this->createForm(SkillType::class, $character, [
        //     'csrf_protection' => false,
        // ]);  

        // // on créer un objet Character
        // $character = new Character();
        // on créer un formulaire pour la classe Character
        // $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);

        // // on récupère les informations de la requête
        // $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        // // on envoie les informations dans le formulaire
        // $form->submit($sentData);
        
        // // si les données sont valides
        // if ($form->isValid()) {

        //     // on associe l'utilisateur au personnage
        //     $character->setUser($user);

        //     // on envoie les données à la BDD
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($character);
        //     $em->flush();
            
        //     // on retourne le personnage créé
        //     return $this->json($character,  201, [], [
        //         'groups' => ['read_character'],
        //     ]);
        // }

        // // si le formulaire n'est pas valide on retourne les erreurs
        // return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT"}, requirements={"id": "\d+"})
     * @OA\Put(
     *      path="/character/{id}",
     *      tags={"Character"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/character"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the character",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/characterInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function edit(Request $request, character $character, CampaignRepository $campaignRepository): Response
    {
        // on récupère l'utilisateur connecté
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

        // on récupère l'ID de la campagne liée au personnage
        $campaignId = $character->getCampaign();

        // si le personnage est lié à une campagne
        if ( $campaignId !== null){
            // on récupère la campagne
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
        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        // on envoie les informations dans le formulaire
        $form->submit($sentData);
        
        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            // on retourne le personnage modifié
            return $this->json($character,  201, [], [
                'groups' => ['read_character'],
            ]);

        }
        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
        
    }

    /**
     * @Route("", name="browse", methods={"GET"})
     * @OA\Get(
     *      path="/character",
     *      tags={"Character"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of characters of the user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/character"))
     *      )
     * )
     */
    public function browse(CharacterRepository $characterRepository): Response
    {
         // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupère les personnages associés à l'utilisateur
        $characters = $characterRepository->findByUser($userId);

        // on retourne la liste des personnages
        return $this->json(
            $characters, 200, [], [
                'groups' => ['browse_character'],
            ]
        );
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Get(
     *      path="/character/{id}",
     *      tags={"Character"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the character",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/characterInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function read(Character $character): Response
    {
        // on retourne le personnage
        return $this->json(
            $character, 200, [], [
                'groups' => ['read_character'],
            ]
        );
    }

    
    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *      path="/character/{id}",
     *      tags={"Character"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
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

        // on demande à la BDD de supprimer le personnage
        $em = $this->getDoctrine()->getManager();
        $em->remove($character);
        $em->flush();
        
        // on retourne un code 204 si le personnage est bien supprimé
        return $this->json(null, 204);
    }

    public function resetCampaign(Character $character): Void
    {
        $character->setCampaign(null);

        $this->getDoctrine()->getManager()>flush();
    }
}