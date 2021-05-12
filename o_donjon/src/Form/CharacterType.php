<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Statistics;
use App\Form\StatisticsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('avatar_path')
            ->add('age')
            ->add('initiative')
            ->add('height')
            ->add('weight')
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
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('user')
            ->add('campaign', CampaignType::class)
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
