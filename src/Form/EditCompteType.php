<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EditCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'E-mail'
            ])
            ->add('dateOfBirth', DateType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Date de naissance'
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Nom d\'utilisateur'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control text-black'
                ],
                'label' => 'Votre description'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
