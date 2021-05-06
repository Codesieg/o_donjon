<?php

namespace App\Controller;

use App\Entity\Map;
use App\Form\MapType;
use App\Repository\MapRepository;
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
     */
    public function browse(MapRepository $mapRepository): Response
    {
        $stories = $mapRepository->findAll();
        return $this->json($stories, 200, [], [
            'groups' => ['browse_map'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $map = new Map();
        $form = $this->createForm(MapType::class, $map, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->json($map, 201, [], [
                'groups' => ['read_map'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Map $map): Response
    {
        return $this->json($map, 200, [], [
            'groups' => ['read_map'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(Map $map, Request $request): Response
    {
        $form = $this->createForm(MapType::class, $map, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->json($map, 200, [], [
                'groups' => ['read_map'],
            ]);
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Map $map): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($map);
        $em->flush();

        return $this->json(null, 204);
    }

}
