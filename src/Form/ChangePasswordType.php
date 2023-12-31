<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true
            ])
            //  ->add('roles')
            //  ->add('password')
            ->add('lastName', TextType::class, [
                'disabled' => true
            ])
            ->add('firstName', TextType::class, [
                'disabled' => true
            ])
            ->add('oldPassword', PasswordType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrer l\'ancien mot de passe']
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrer le nouveau mot de passe']
            ])
            ->add('confirmNewPassword', PasswordType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Confirmer le nouveau  mot de passe']
            ])
            ->add('submit', SubmitType::class, ['label' => 'Modification du mot de passe','attr'=>['class'=>'col-12 btn btn-primary']]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
