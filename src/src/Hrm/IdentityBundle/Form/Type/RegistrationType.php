<?php

namespace App\Hrm\IdentityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                [
                    'translation_domain' => 'HrmIdentityBundle',
                    'label'              => 'REGISTRATION.LABEL.FIRST_NAME',
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'translation_domain' => 'HrmIdentityBundle',
                    'label'              => 'REGISTRATION.LABEL.LAST_NAME',
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'translation_domain' => 'HrmIdentityBundle',
                    'label'              => 'REGISTRATION.LABEL.EMAIL',
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'translation_domain' => 'HrmIdentityBundle',
                    'label'              => 'REGISTRATION.LABEL.PASSWORD',
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'translation_domain' => 'HrmIdentityBundle',
                    'label' => 'REGISTRATION.BUTTON.SIGN_UP',
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_hrm_identity_registration_index';
    }
}
