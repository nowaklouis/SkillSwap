<?php

namespace App\Form;

use App\Entity\Swap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SwapFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Sujet'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Description'
            ])
            ->add('date', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Date et heure'
            ])
            ->add('duration', TimeType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Durée(en heure)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Swap::class,
        ]);
    }
}
