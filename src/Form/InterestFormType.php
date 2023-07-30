<?php

namespace App\Form;

use App\Entity\Interest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('interest', ChoiceType::class, [
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
                'label' => 'Intérêt'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interest::class,
        ]);
    }
}
