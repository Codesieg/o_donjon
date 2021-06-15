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
     * @Route("/dm/map", name="dm_map_")
     */

class MapController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(MapRepository $mapRepository): Response
    {   
        
        // on retourne la liste des maps
        return $this->render('map/index.html.twig', [
            // on récupère les campagnes dont l'utilisateur est le DM
            'maps' => $mapRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        // on créer un objet map
        $map = new Map();

        // on créer un formulaire pour la classe Map
        $form = $this->createForm(MapType::class, $map);

        // Form handling with request
        $form->handleRequest($request);

        // si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            // on retourne la map créée
            $this->addFlash('success', 'Nouvelle carte enregistrée.');

            return $this->redirectToRoute('dm_map_browse');
        }

        // If form submitting and validation NOT Ok, then registration form display
        return $this->render('map/add.html.twig', [
        'form' => $form->createView(),
]);
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Map $map): Response
    {   
        return $this->render('map/read.html.twig', [
            'map' => $map,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     */
    public function edit(Map $map, Request $request): Response
    {   
        // on créer un formulaire pour la classe Map
        $form = $this->createForm(MapType::class, $map);
        $form->handleRequest($request);

        // si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {

            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne la map modifiée
            return $this->redirectToRoute('dm_map_browse');
        }
            // If form submitting and validation NOT Ok, then registration form display
            return $this->render('map/edit.html.twig', [
                'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function delete(Map $map): Response
    {   
        // on supprime la map de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($map);
        $em->flush();

        // on retourne un code 204 si la map a bien été supprimée
        return $this->redirectToRoute('dm_map_browse');
    }

}
