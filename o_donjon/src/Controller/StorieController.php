<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/story", name="story_")
     */

class StorieController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(StoryRepository $storyRepository): Response
    {
        $stories = $storyRepository->findAll();
        return $this->json($stories, 200, [], [
            'groups' => ['browse'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $story = new Story();
        $form = $this->createForm(StoryType::class, $story, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();

            return $this->json($story, 201, [], [
                'groups' => ['read'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Story $story): Response
    {
        return $this->json($story, 200, [], [
            'groups' => ['read'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(Story $story, Request $request): Response
    {
        $form = $this->createForm(StoryType::class, $story, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->json($story, 200, [], [
                'groups' => ['read'],
            ]);
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Story $story): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($story);
        $em->flush();

        return $this->json(null, 204);
    }

}
