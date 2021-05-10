<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acrobatics')
            ->add('animalHandling')
            ->add('arcana')
            ->add('athletics')
            ->add('deception')
            ->add('history')
            ->add('insight')
            ->add('intimidation')
            ->add('investigation')
            ->add('medecine')
            ->add('nature')
            ->add('perception')
            ->add('performance')
            ->add('persuasion')
            ->add('religion')
            ->add('sleightOfHand')
            ->add('stealth')
            ->add('survival')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
