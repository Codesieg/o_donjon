<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use OpenApi\Annotations as OA;
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
     * @OA\Get(
     *      path="/story",
     *      tags={"Story"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of stories",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/storyInfo"))
     *      )
     * )
     */
    public function browse(StoryRepository $storyRepository): Response
    {   
        // on récupère les histoires
        $stories = $storyRepository->findAll();

        // on retourne la liste des histoires
        return $this->json($stories, 200, [], [
            'groups' => ['browse_story'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     * @OA\Post(
     *      path="/story",
     *      tags={"Story"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/story"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the story",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/storyInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function add(Request $request): Response
    {   
        // on créer un objet Story
        $story = new Story();

        // on créer un formulaire pour la classe Storie
        $form = $this->createForm(StoryType::class, $story, ['csrf_protection' => false]);
        
        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);
        
        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();

            // on retourne l'histoire créée
            return $this->json($story, 201, [], [
                'groups' => ['read_story'],
            ]);
        }
        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Get(
     *      path="/story/{id}",
     *      tags={"Story"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the story",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/storyInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function read(Story $story): Response
    {   
        // on retourne l'histoire concernée
        return $this->json($story, 200, [], [
            'groups' => ['read_story'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     * @OA\Put(
     *      path="/story/{id}",
     *      tags={"Story"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/story"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the story",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/storyInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function edit(Story $story, Request $request): Response
    {   
        // on créer un formulaire pour la classe Story
        $form = $this->createForm(StoryType::class, $story, ['csrf_protection' => false]);

        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne l'histoire modifiée
            return $this->json($story, 200, [], [
                'groups' => ['read_story'],
            ]);
        }
         // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *      path="/story/{id}",
     *      tags={"Story"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
     */
    public function delete(Story $story): Response
    {   
        // on supprime l'histoire de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($story);
        $em->flush();

        // on retourne un code 204 si l'histoire a bien été supprimée
        return $this->json(null, 204);
    }

}
