<?php

namespace App\Hrm\CompanyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'translation_domain' => 'HrmCompanyBundle',
                    'label'              => 'MANAGEMENT.LABEL.NAME',
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'translation_domain' => 'HrmCompanyBundle',
                    'label'              => 'MANAGEMENT.LABEL.ADDRESS',
                    'required'           => false,
                ]
            )
            ->add(
                'logoFile',
                FileType::class,
                [
                    'translation_domain' => 'HrmCompanyBundle',
                    'label'              => 'MANAGEMENT.LABEL.LOGO',
                    'required'           => false,
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'translation_domain' => 'HrmCommonBundle',
                    'label'              => 'BUTTON.SAVE',
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_hrm_company_create_index';
    }
}
