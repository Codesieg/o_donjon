<?php

namespace App\Form;

use App\Entity\Statistics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('strength', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('dexterity', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('constitution', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('intelligence', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('wisdom', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('charisma', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('passiveWisdom', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('proficiencyBonus', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Statistics::class,
            "allow_extra_fields" => true
        ]);
    }
}
