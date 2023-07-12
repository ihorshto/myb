<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'required' => false  // ajoute ( true) ou pas(false) un required côté front
            ])
            ->add('lastName', TextType::class, ['label' => false, 'attr' => [
                'placeholder' => 'Votre Nom'],
                'required' => false
                ])
            ->add('firstName', TextType::class, ['label' => false,
             'attr' => ['placeholder' => 'Votre prénom'],
             'required' => false
             ])
             ->add('pseudo', TextType::class, ['label' => false,
             'attr' => ['placeholder' => 'Votre pseudo'],
             'required' => false
             ])
            //  ->add('roles')
            ->add('password', PasswordType::class,[
                'required' => false
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false, 
                'attr' => ['placeholder' => 'Confirmation du mot de passe'],
                'required' => false
                ])
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire','attr'=>['class'=>'col-12 btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['register'],
        ]);
    }
}
