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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/character", name="character_")
*/

class CharacterController extends AbstractController
{
    /**
     * @Route("/add", name="add")
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

        // on créer un objet formulaire à partir de Character type et on y associe l'objet character
        $form = $this->createForm(CharacterType::class, $character);

         // On demande au formulaire d'analyser la requète et d'en retirer
        // les informations reçues en POST, s'il les trouve il remplit les informations dans $character
        $form->handleRequest($request);

        // On demande au formulaire s'il est valide, c'est-à-dire qu'on lui demande de vérifier qu'il n'y a aucune erreur dedans*
        if ($form->isSubmitted() && $form->isValid()) {
            // Ici on est dans le cas où le formulaire est envoyé et valide (valide : tous les champs sont «correctes»)
            // On peut persister $character
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();

            // on envoie un message de succès
            $this->addFlash('success', 'Le personnage' . $character->getName() . ', ' . $character->getRace()->getName() . ', ' . $character->getClass()->getName() . ' a bien été ajouté');

            //on redirige vers la page d'édition du personnage
            return $this->redirectToRoute('player_home');
        }

        return $this->render('character/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function edit(Request $request): Response 
    {
        return $this->render('character/index.html.twig', [
            'controller_name' => 'CharacterController',
        ]); 
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Character $character): Response
    {   
        
        return $this->render('character/read.html.twig', [
            'character' => $character,
        ]); 
    }

}
