<?php

namespace App\Form;

use App\Entity\Spell;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('spellcasting_class')
            ->add('spell_attack_bonus', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('spellcasting_ability', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('spell_save_dc', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('spells_list', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spell::class,
            "allow_extra_fields" => true
        ]);
    }
}
