<?php

namespace App\Form;

use App\Entity\Map;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filePath')
            ->add('name')
            ->add('description', CKEditorType::class, [
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
            'data_class' => Map::class,
            "allow_extra_fields" => true
        ]);
    }
}
