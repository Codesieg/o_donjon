<?php

namespace App\Controller;

use App\Entity\NPC;
use App\Form\NPCType;
use App\Repository\NPCRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/npc", name="npc_")
     */

class NpcController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     * @OA\Get(
     *      path="/nps",
     *      tags={"NPC"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of NPCs",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/npcInfo"))
     *      )
     * )
     */
    public function browse(NPCRepository $npcRepository): Response
    {   
        // on récupère les NPCs
        $npcs = $npcRepository->findAll();

        // on retourne la liste des NPCs
        return $this->json($npcs, 200, [], [
            'groups' => ['browse_npc'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     * @OA\Post(
     *      path="/npc",
     *      tags={"NPC"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/npc"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the NPC",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/npcInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function add(Request $request): Response
    {   
        // on créer un objet NPC
        $npc = new NPC();

        // on créer un formulaire pour la classe NPC
        $form = $this->createForm(NPCType::class, $npc, ['csrf_protection' => false]);

        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {
            
            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($npc);
            $em->flush();

            // on retourne le NPC créé
            return $this->json($npc, 201, [], [
                'groups' => ['read_npc'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Get(
     *      path="/npc/{id}",
     *      tags={"NPC"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the NPC",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/npcInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function read(NPC $npc): Response
    {   

        // on retourne le NPC concerné
        return $this->json($npc, 200, [], [
            'groups' => ['read_npc'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     * @OA\Put(
     *      path="/npc/{id}",
     *      tags={"NPC"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/npc"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the NPC",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/npcInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function edit(NPC $npc, Request $request): Response
    {   
        // on créer un formulaire pour la classe NPC
        $form = $this->createForm(NPCType::class, $npc, ['csrf_protection' => false]);

        // on récupère les informations de la requête 
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);
        
        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne le NPC modifié
            return $this->json($npc, 200, [], [
                'groups' => ['read_npc'],
            ]);
        }

        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *      path="/npc/{id}",
     *      tags={"NPC"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
     */
    public function delete(NPC $npc): Response
    {   
        // on supprime le NPC de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($npc);
        $em->flush();

        // on retourne un code 204 si le NPC a bien été supprimé
        return $this->json(null, 204);
    }

}
