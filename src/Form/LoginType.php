<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Matricule', IntegerType::class, [
                'attr'=> [
                    'placeholder' => 'Saisir votre matricule',
                    'class' => 'form-control'
                ]
            ])


            ->add('password', PasswordType::class, [
                'attr'=> [
                    'placeholder' => 'Saisir votre mot de passe',
                    'class' => 'form-control'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
