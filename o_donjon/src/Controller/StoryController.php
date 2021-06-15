<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/story", name="dm_story_")
     */
class StoryController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(StoryRepository $storyRepository): Response
    {
        return $this->render('story/index.html.twig', [
            'stories' => $storyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        // on créer un objet map
        $map = new Story();

        // on créer un formulaire pour la classe Map
        $form = $this->createForm(StoryType::class, $map);

        // Form handling with request
        $form->handleRequest($request);

        // si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            // on retourne la map créée
            $this->addFlash('success', 'Nouvelle histoire enregistrée.');

            return $this->redirectToRoute('dm_story_browse');
        }

        // If form submitting and validation NOT Ok, then registration form display
        return $this->render('story/add.html.twig', [
        'form' => $form->createView(),
]);
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Story $story): Response
    {   
        return $this->render('story/read.html.twig', [
            'story' => $story,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     */
    public function edit(Story $story, Request $request): Response
    {   
        // on créer un formulaire pour la classe story
        $form = $this->createForm(storyType::class, $story);
        $form->handleRequest($request);

        // si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne la story modifiée
            return $this->redirectToRoute('dm_story_browse');
        }
            // If form submitting and validation NOT Ok, then registration form display
            return $this->render('story/edit.html.twig', [
                'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function delete(Story $story): Response
    {   
        // on supprime la story de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($story);
        $em->flush();

        // on retourne un code 204 si la story a bien été supprimée
        return $this->redirectToRoute('dm_story_browse');
    }
}
