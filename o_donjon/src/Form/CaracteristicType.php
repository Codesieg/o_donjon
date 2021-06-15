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
            ->add('level', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('experience', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('inspiration', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('armorClass', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('speed', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('currentHP', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('totalHP', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('hitDice')
            ->add('deathSavesSuccess', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('deathSavesFailures', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
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
