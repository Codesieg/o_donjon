<?php

namespace App\Form;

use App\Entity\Character;
use App\Form\StatisticsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('avatar_path')
            ->add('age', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('initiative', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('height', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('weight', null, [
                'required'   => false,
                'empty_data' => '0',
            ])
            ->add('eyes')
            ->add('skin')
            ->add('hair')
            ->add('appearance')
            ->add('personality_traits')
            ->add('ideals')
            ->add('bonds')
            ->add('flaws')
            ->add('allies_and_organizations')
            ->add('backstory')
            ->add('treasure')
            ->add('background')
            ->add('alignement')
            ->add('attacks_and_spellcasting')
            ->add('equipment')
            ->add('other_proficiencies_and_languages')
            ->add('features_and_traits')
            ->add('isDead')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('user')
            // ->add('campaign')
            ->add('race', RaceType::class)
            ->add('class', CharacterClassType::class)
            ->add('caracteristics',CaracteristicType::class)
            ->add('statistics', StatisticsType::class)
            ->add('spell',SpellType::class)
            ->add('savingThrowspell', SavingThrowType::class)
            ->add('skill', SkillType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
            "allow_extra_fields" => true
        ]);
    }
}
