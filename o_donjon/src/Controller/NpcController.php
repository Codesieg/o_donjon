<?php

namespace App\Controller;

use App\Entity\NPC;
use App\Form\NPCType;
use App\Repository\NPCRepository;
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
     */
    public function browse(NPCRepository $npcRepository): Response
    {
        $stories = $npcRepository->findAll();
        return $this->json($stories, 200, [], [
            'groups' => ['browse_npc'],
        ]);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $npc = new NPC();
        $form = $this->createForm(NPCType::class, $npc, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($npc);
            $em->flush();

            return $this->json($npc, 201, [], [
                'groups' => ['read_npc'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(NPC $npc): Response
    {
        return $this->json($npc, 200, [], [
            'groups' => ['read_npc'],
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(NPC $npc, Request $request): Response
    {
        $form = $this->createForm(NPCType::class, $npc, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->json($npc, 200, [], [
                'groups' => ['read_npc'],
            ]);
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(NPC $npc): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($npc);
        $em->flush();

        return $this->json(null, 204);
    }

}
