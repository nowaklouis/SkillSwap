<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('skillname', ChoiceType::class, [
                'choices' => [
                    'Math' => 'math',
                    'Géographie' => 'geographie',
                    'Histoire' => 'histoire',
                    'Littérature' => 'literature',
                    'Philosophie' => 'philosophie',
                    'Physique' => 'physique',
                    'Anglais' => 'anglais',
                    'Allemand' => 'allemand'
                ],
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Compétence'
            ])
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Niveau 1' => '1',
                    'Niveau 2' => '2',
                    'Niveau 3' => '3',
                    'Niveau 4' => '4',
                    'Niveau 5' => '5',
                ],
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Niveau'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Description'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
