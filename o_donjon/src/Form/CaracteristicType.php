<?php

namespace App\Form;

use App\Entity\Caracteristic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaracteristicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('level')
            ->add('experience')
            ->add('inspiration')
            ->add('armorClass')
            ->add('speed')
            ->add('currentHP')
            ->add('totalHP')
            ->add('hitDice')
            ->add('deathSavesSuccess')
            ->add('deathSavesFailures')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caracteristic::class,
            "allow_extra_fields" => true
        ]);
    }
}
