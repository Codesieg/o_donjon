<?php

namespace App\Form;

use App\Entity\SavingThrow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SavingThrowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('strength')
            ->add('dexterity')
            ->add('constitution')
            ->add('intelligence')
            ->add('wisdom')
            ->add('charisma')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SavingThrow::class,
            "allow_extra_fields" => true
        ]);
    }
}
