<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Character;
use App\Entity\Statistics;
use App\Form\CharacterType;
use App\Form\StatisticsType;
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
    {
        // Create a new character 
        $character = new Character();
        $em = $this->getDoctrine()->getManager();
        $em->persist($character);
        // Create a new forms character  
        $form = $this->createForm(CharacterType::class, $character, ['csrf_protection' => false]);
        $sentData = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $form->submit($sentData);
        $form->getData();

        $em->persist($character);

           // Create a new stats 
        $stats = new Statistics();
        $em = $this->getDoctrine()->getManager();
        $em->persist($stats);
           // Create a new forms character  
        $formStat= $this->createForm(StatisticsType::class, $stats, ['csrf_protection' => false]);
           $sentDataStats = json_decode($request->getContent(), true); // On definit le parametre à true afin de retourner un tableau associatif
        $formStat->submit($sentDataStats);
        // $formStat->getData();
        //    dd($formStat);
        $em = $this->getDoctrine()->getManager();
        $em->persist($stats);
        // dd($stats);
        $em->flush();

        // if ($form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($character);
        //     // $em->persist($statistics);
        //     $em->flush();

            return $this->json(['character' => $character, 'statistics' => $stats],  201, [], [
                'groups' => ['read_character'],
            ]);
        // }
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