<?php

namespace App\Form;

use App\Entity\Story;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class StoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', CKEditorType::class, [
                'config'      => array('uiColor' => '#ffffff'),
                ])
            ->add('isDone')
            ->add('report', CKEditorType::class, [
                'config'      => array('uiColor' => '#ffffff'),
                ])
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('campaign')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Story::class,
            "allow_extra_fields" => true
        ]);
    }
}
