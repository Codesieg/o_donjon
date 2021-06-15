<?php

namespace App\Form;

use App\Entity\Campaign;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            // ->add('isArchived')
            ->add('description', CKEditorType::class, [
                'config'      => array('uiColor' => '#ffffff'),
                ])
            ->add('memo', CKEditorType::class, [
                'config'      => array('uiColor' => '#ffffff'),
                ])
            // ->add('description')
            // ->add('memo')
            // ->add('invitationCode')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('owner')
            // ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
            'allow_extra_fields' => true
        ]);
    }
}
