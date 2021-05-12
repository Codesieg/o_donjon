<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\User;
use App\Form\CampaignType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
     * @Route("", name="user_")
     */

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
        $requestId = filter_var($request->getPathInfo(), FILTER_SANITIZE_NUMBER_INT);

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
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->json(null, 204);
    }


    /***********************************************ADVANCED METHODS**************************************/

    /**
     * AUTHORIZE A USER TO JOIN A CAMPAIGN
     * 
     * @Route("/{id}/campaign/{campaign_id}", name="add_campaign", methods={"POST"})
     * 
     * @ParamConverter("user", options={"mapping": {"id": "id"}})
     * @ParamConverter("campaign", options={"mapping": {"campaign_id": "id"}})
     * 
     */
    public function addCampaign(Request $request, User $user, Campaign $campaign): Response
    {
        // Identify campaign Id
        $campaignId = $campaign->getId();
        // Identify campaign invitation code
        $campaignInvitationCode = $campaign->getInvitationCode();

        // Transform request json content
        $sentData = json_decode($request->getContent(), true);
        $requestInvitationCode = $sentData['invitation_code'];

        // Check invitation code
        if ($requestInvitationCode == $campaignInvitationCode) {
            
            // Add the user to the campaign
            $campaign->addUser($user);
            
            // Associate form and character 
            $form = $this->createForm(CampaignType::class, $campaign, [
            'csrf_protection' => false
            ]);
            
            // Submit updated data
            $form->submit($sentData);

            // Check and responses
            if ($form->isValid()) {
                
                // Update the DB
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                
                $responseData = [
                    'status' => 'success',
                    'message' => 'Ok, you can join the campaign !'
                ];
                
                return $this->json($responseData, 200, []);

            } else {
                $responseData = [
                    'status' => 'error',
                    'message' => 'A problem occurs !'
                ];
                return $this->json($responseData, 400, []);
            }
        } else {
            $responseData = [
                'status' => 'error',
                'message' => 'This invitation code is not valid !'
            ];
            return $this->json($responseData, 401, []);
        }
    }

}