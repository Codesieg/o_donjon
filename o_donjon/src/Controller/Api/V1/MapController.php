<?php

namespace App\Controller\Api\V1;

use App\Entity\Map;
use App\Form\MapType;
use App\Repository\MapRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/map", name="map_")
     */

class MapController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     * @OA\Get(
     *      path="/map",
     *      tags={"Map"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of maps",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/map"))
     *      )
     * )
     */
    public function browse(MapRepository $mapRepository): Response
    {   
        // on récupère les maps
        $maps = $mapRepository->findAll();

        // on retourne la liste des maps
        return $this->json($maps, 200, [], [
            'groups' => ['browse_map'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     * @OA\Post(
     *      path="/map",
     *      tags={"Map"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/map"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the map",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/mapInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function add(Request $request): Response
    {
        // on créer un objet map
        $map = new Map();

        // on créer un formulaire pour la classe Map
        $form = $this->createForm(MapType::class, $map, ['csrf_protection' => false]);

        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            // on retourne la map créée
            return $this->json($map, 201, [], [
                'groups' => ['read_map'],
            ]);
        }

        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Get(
     *      path="/map/{id}",
     *      tags={"Map"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the map",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/mapInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function read(Map $map): Response
    {   
        // on retourne la map concernée
        return $this->json($map, 200, [], [
            'groups' => ['read_map'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     * @OA\Put(
     *      path="/map/{id}",
     *      tags={"Map"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/map"),
     *      @OA\Response(
     *          response="200",
     *          description="Informations of the map",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/mapInfo"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound"),
     * )
     */
    public function edit(Map $map, Request $request): Response
    {   
        // on créer un formulaire pour la classe Map
        $form = $this->createForm(MapType::class, $map, ['csrf_protection' => false]);
        
        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne la map modifiée
            return $this->json($map, 200, [], [
                'groups' => ['read_map'],
            ]);
        }
        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *      path="/map/{id}",
     *      tags={"Map"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
     */
    public function delete(Map $map): Response
    {   
        // on supprime la map de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($map);
        $em->flush();

        // on retourne un code 204 si la map a bien été supprimée
        return $this->json(null, 204);
    }

}
