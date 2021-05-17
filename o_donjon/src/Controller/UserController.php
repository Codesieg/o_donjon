<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\User;
use App\Form\CampaignType;
use App\Form\UserType;
use App\Repository\CampaignRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="browse", methods={"GET"})
     */
    public function browse(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->json($users, 200, [], [
            'groups' => ['browse_user'],
        ]);
    }

    /**
     * @Route("/login", name="add", methods={"POST"})
     */
    public function add(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['csrf_protection' => false]);

        $sentData = json_decode($request->getContent(), true);
        $form->submit($sentData);

        if ($form->isValid()) {
            $password = $form->get('password')->getData();
            $user->setPassword($passwordEncoder->encodePassword($user, $password));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->json($user, 201, [], [
                'groups' => ['read_user'],
            ]);
        }

        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/user/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(User $user): Response
    {
        return $this->json($user, 200, [], [
            'groups' => ['read_user'],
        ]);
    }    

    /**
     * @Route("/user/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     */
    public function edit(UserPasswordEncoderInterface $passwordEncoder, Request $request, User $user): Response
    {   
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID envoyer par la requête
        $requestId = $user->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $requestId) {
            return $this->json('wrong user ID', 401);
        }

        // on récupère les informations de la requête
        $requestData = json_decode($request->getContent(), true);

        $form = $this->createForm(UserType::class, $user, ['csrf_protection' => false]);
        $form->submit($requestData);

        if ($form->isValid()) {

            $password = $form->get('password')->getData();

            if ($password !== null) {
                $encodedPassword = $passwordEncoder->encodePassword($user, $password);
                $user->setPassword($encodedPassword);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->json($user, 201, [], [
                'groups' => ['read_user'],
            ]);
        }
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/user/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(User $user): Response
    {

        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID du owner de la campagne
        $requestId = $user->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $requestId) {
            return $this->json('wrong user ID', 401);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->json(null, 204);
    }


    /***********************************************ADVANCED METHODS**************************************/

    /**
     * AUTHORIZE A USER TO JOIN THE CAMPAIGN CORRESPONDING TO HIS INVITATION CODE
     * 
     * @Route("/user/campaign/join", name="user_campaign_join", methods={"POST"})
     * 
     */
    public function joinCampaign(Request $request, CampaignRepository $campaignRepository): Response
    {
        // Identify the user
        $user = $this->getUser();

        // Transform received json content to an associated array
        $sentData = json_decode($request->getContent(), true);
        
        // Recover the invitation code from the associated array
        $requestedInvitationCode = $sentData['invitationCode'];
                
        // Identify the campaign corresponding to the invitation code
        $requestedCampaign = $campaignRepository->findBy(array('invitationCode' => $requestedInvitationCode));

        // If no campaign found, send an error message
        if (empty($requestedCampaign)) {
            $responseData = [
                'status' => 'error',
                'message' => 'This invitation code is not valid !'
            ];
            
            return $this->json($responseData, 401, []);
        } 

        // Else add the user to the campaign
        $joinedCampaign = $requestedCampaign[0];
        $joinedCampaign->addUser($user);
        $joinedCampaignName = $joinedCampaign->getName();

        // Update the DB
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        // Reurn a success message
        $responseData = [
            'status' => 'success',
            'message' => 'Yeah, you have joined the campaign ' . $joinedCampaignName . ' !'
        ];
        
        return $this->json($responseData, 200, []);

    }

}