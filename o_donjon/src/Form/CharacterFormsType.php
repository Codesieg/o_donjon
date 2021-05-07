<?php

namespace App\Form;

use App\Form\CharacterType;
use App\Form\StatisticsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class CharacterFormsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', CharacterType::class)
            ->add('avatar_path', CharacterType::class)
            ->add('avatar_path', CharacterType::class)
            ->add('age', CharacterType::class)
            ->add('initiative', CharacterType::class)
            ->add('height', CharacterType::class)
            ->add('weight', CharacterType::class)
            ->add('eyes', CharacterType::class)
            ->add('skin', CharacterType::class)
            ->add('hair', CharacterType::class)
            ->add('appearance', CharacterType::class)
            ->add('personality_traits', CharacterType::class)
            ->add('ideals', CharacterType::class)
            ->add('bonds', CharacterType::class)
            ->add('flaws', CharacterType::class)
            ->add('allies_and_organizations', CharacterType::class)
            ->add('backstory', CharacterType::class)
            ->add('treasure', CharacterType::class)
            ->add('background', CharacterType::class)
            ->add('alignement', CharacterType::class)
            ->add('attacks_and_spellcasting', CharacterType::class)
            ->add('equipment', CharacterType::class)
            ->add('other_proficiencies_and_languages', CharacterType::class)
            ->add('features_and_traits', CharacterType::class)
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('user', CharacterType::class)
            ->add('campaign', CharacterType::class)
            ->add('race', CharacterType::class)
            ->add('class', CharacterType::class)
            ->add('caracteristics', CharacterType::class)
            ->add('statistics', CharacterType::class)
            ->add('spell', CharacterType::class)
            ->add('savingThrowspell', CharacterType::class)
            ->add('skill', CharacterType::class)
            // Champs des stats :
            ->add('strength', StatisticsType::class)
            ->add('dexterity', StatisticsType::class)
            ->add('constitution', StatisticsType::class)
            ->add('intelligence', StatisticsType::class)
            ->add('wisdom', StatisticsType::class)
            ->add('charisma', StatisticsType::class)
            ->add('passiveWisdom', StatisticsType::class)
            ->add('proficiencyBonus', StatisticsType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
