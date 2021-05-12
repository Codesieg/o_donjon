<?php

namespace App\EventListener;


use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        // dump($user);

        // if (!$user instanceof UserInterface) {
        //     return;
        // }

        $data['data'] = array(
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName()
        );

        // dd($data);

        $event->setData($data);
    }
}
