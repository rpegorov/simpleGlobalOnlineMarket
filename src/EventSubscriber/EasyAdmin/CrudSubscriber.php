<?php
namespace App\EventSubscriber\EasyAdmin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CrudSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['hashPassWord'],
            BeforeEntityUpdatedEvent::class => ['hashPassWord'],
            BeforeEntityDeletedEvent::class
        ];
    }

    public function hashPassWord(BeforeEntityUpdatedEvent|BeforeEntityPersistedEvent $event)
    {

        $entity = $event->getEntityInstance();
        if (!($entity instanceof User)) {
            return;
        }
        $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $entity->getPassword()));
    }
}