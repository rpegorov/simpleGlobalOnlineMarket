<?php

namespace App\Controller\Admin;

use App\Admin\Field\InternationalPhoneField;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserCrudController extends AbstractCrudController {

    public static function getEntityFqcn(): string {
        return User::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('uuid')->hideOnForm(),
            TextField::new('password', 'password')
                ->hideOnIndex()
                ->setRequired(true)
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type'            => PasswordType::class,
                    'first_options'   => ['label' => 'New password'],
                    'second_options'  => ['label' => 'Repeat password'],
                    'error_bubbling'  => true,
                    'invalid_message' => 'The password fields do not match.',
                ]),
            EmailField::new('email', 'email')
                ->setRequired(true)
                ->setFormTypeOptions([
                    //'type'            => EmailType::class,
                    'label'           => 'New email',
                    'error_bubbling'  => true,
                    'invalid_message' => 'The email field do not correctly.',
                ]),

            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->setChoices([
                    'Разработка'    => 'ROLE_DEVELOPER',
                    'Пользователь'  => 'ROLE_USER',
                    'Администратор' => 'ROLE_ADMIN',
                ]),
        ];
    }
}
