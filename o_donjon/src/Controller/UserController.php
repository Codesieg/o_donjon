<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\User;
use App\Form\CampaignType;
use App\Form\UserType;
use App\Repository\CampaignRepository;
use App\Repository\UserRepository;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @OA\Get(
 *      path="/login_check",
 *      tags={"User"},
 *      security={"bearer"},
 *      @OA\RequestBody(ref="#/components/requestBodies/connectionUser"),
 *      @OA\Response(
 *          response="200",
 *          description="data of the connected user",
 *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/connectionUser"))
 *      )
 * )
 */

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="browse", methods={"GET"})
     * @OA\Get(
     *      path="/user",
     *      tags={"User"},
     *      security={"bearer"},
     *      @OA\Response(
     *          response="200",
     *          description="List of the users",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/userList"))
     *      )
     * )
     */
    public function browse(UserRepository $userRepository): Response
    {   
        // on récupère les utilisateurs
        $users = $userRepository->findAll();

        // on retourne la liste des utilisateurs
        return $this->json($users, 200, [], [
            'groups' => ['browse_user'],
        ]);
    }

    /**
     * @Route("/login", name="add", methods={"POST"})
     * @OA\Post(
     *      path="/login",
     *      tags={"User"},
     *      @OA\RequestBody(ref="#/components/requestBodies/registerUser"),
     *      @OA\Response(
     *          response="201",
     *          description="Register new user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/user"))
     *      )
     * )
     */
    public function add(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {   
        // on créé un objet User
        $user = new User();

        // on créer un formulaire pour la classe User
        $form = $this->createForm(UserType::class, $user, ['csrf_protection' => false]);

        // on récupère les informations de la requête
        $sentData = json_decode($request->getContent(), true);

        // on envoie les informations dans le formulaire
        $form->submit($sentData);

        // si les données sont valides
        if ($form->isValid()) {

            // on récupère le mdp saisi par l'utilisateur
            $password = $sentData['password'];

            // on encode le mdp
            $user->setPassword($passwordEncoder->encodePassword($user, $password));

            // on envoie les données à la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            // on retourne l'utilisateur créé
            return $this->json($user, 201, [], [
                'groups' => ['read_user'],
            ]);
        }

        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/user/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     * @OA\Get(
     *      path="/user/{id}",
     *      tags={"User"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="200",
     *          description="User informations",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/user"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
     */
    public function read(User $user): Response
    {   
        // on récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();

        // on récupére l'ID envoyer par la requête
        $requestId = $user->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $requestId) {
            return $this->json('wrong user ID', 401);
        }

        // on retourne l'utilisateur concerné
        return $this->json($user, 200, [], [
            'groups' => ['read_user'],
        ]);
    }    

    /**
     * @Route("/user/{id}", name="edit", methods={"PUT", "PATCH"}, requirements={"id": "\d+"})
     * @OA\Put(
     *      path="/user/{id}",
     *      tags={"User"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\RequestBody(ref="#/components/requestBodies/registerUser"),
     *      @OA\Response(
     *          response="200",
     *          description="User informations",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/user"))
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
     */
    public function edit(UserPasswordEncoderInterface $passwordEncoder, Request $request, User $user): Response
    {   
        // on récupère l'ID et le mot de passe de l'utilisateur connecté
        $userId = $this->getUser()->getId();
        // $userPassword = $this->getUser()->getPassword();
        
        // on récupére l'ID envoyer par la requête
        $requestId = $user->getId();

        // on compare les deux ID et si ils sont différents alors on retourne une erreur
        if ($userId != $requestId) {
            return $this->json('wrong user ID', 401);
        }

        // on récupère les informations de la requête
        $requestData = json_decode($request->getContent(), true);     

        // si aucun mot de passe n'est transmis, on récupère celui de l'utilisateur connecté
        /* if (!array_key_exists("password", $requestData)) {
            $requestData["password"] = $userPassword;
        }  */

        // on récupère les informations de la requête
        $form = $this->createForm(UserType::class, $user, ['csrf_protection' => false]);


        // on envoie les informations dans le formulaire
        $form->submit($requestData);



        // si les données sont valides
        if ($form->isValid()) {

            // on récupère le mdp saisi par l'utilisateur
            $password = (isset($requestData['password']) ? $requestData['password'] : null);

            // si le mdp n'est pas nul
            if ($password !== null) {
                // on encode le mdp
                $encodedPassword = $passwordEncoder->encodePassword($user, $password);
                $user->setPassword($encodedPassword);
            }
            
            // on envoie les données à la BDD
            $this->getDoctrine()->getManager()->flush();

            // on retourne l'utilisateur modifié
            return $this->json($user, 201, [], [
                'groups' => ['read_user'],
            ]);
        }
        // si le formulaire n'est pas valide on retourne les erreurs
        return $this->json($form->getErrors(true, false)->__toString(), 400);
    }

    /**
     * @Route("/user/{id}", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *      path="/user/{id}",
     *      tags={"User"},
     *      security={"bearer"},
     *      @OA\Parameter(ref="#/components/parameters/id"),
     *      @OA\Response(
     *          response="204",
     *          description="",
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
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

        // on supprime l'histoire de la BDD
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        // on retourne un code 204 si l'utilisateur a bien été supprimée
        return $this->json(null, 204);
    }


    /***********************************************ADVANCED METHODS**************************************/

    /* AUTHORIZE A USER TO JOIN THE CAMPAIGN CORRESPONDING TO HIS INVITATION CODE */
    
    /**
     * @Route("/user/campaign/join", name="user_campaign_join", methods={"POST"})
     * @OA\Post(
     *      path="/user/campaign/join",
     *      tags={"User"},
     *      security={"bearer"},
     *      @OA\RequestBody(ref="#/components/requestBodies/joinCampaignUser"),
     *      @OA\Response(
     *          response="200",
     *          description="User informations",
     *          @OA\JsonContent(
     *              @OA\Property(property="message",type="string", example="Yeah, you have joined the campaign")
     *          ),
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Campaign not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message",type="string", example="This invitation code is not valid !")
     *          ),
     *      ),
     *      @OA\Response(response="404", ref="#/components/responses/notFound")
     * )
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