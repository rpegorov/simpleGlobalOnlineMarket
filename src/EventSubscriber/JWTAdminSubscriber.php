<?php

namespace App\EventSubscriber;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class JWTAdminSubscriber implements EventSubscriberInterface {

    private TokenStorageInterface $tokenStorageInterface;
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager) {
        $this->jwtManager            = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public static function getSubscribedEvents(): array {
        return [
            Events::JWT_EXPIRED            => ['onFailure'],
            Events::JWT_NOT_FOUND          => ['onFailure'],
            Events::AUTHENTICATION_FAILURE => ['onFailure'],
            Events::JWT_INVALID            => ['onFailure'],
            LogoutEvent::class             => ['onLogout'],
        ];
    }

    public function onLogout(LogoutEvent $event) {
        $event->setResponse(new RedirectResponse("/admin/login"));
    }

    public function onFailure(AuthenticationFailureEvent $event) {
        if($event->getRequest()->attributes->get('_route') == 'admin') {
            $event->setResponse(new RedirectResponse("/admin/login"));
        }
    }
}