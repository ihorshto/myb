<?php

namespace App\Form;

use App\Entity\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Nommez votre adresse'
                ]

            ])
            ->add('firstName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre prénom'
                ]

            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre nom'
                ]

            ])
            ->add('company', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeHolder' => 'Votre société'
                ]

            ])
            ->add('address', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre adresse'
                ]

            ])
            ->add('zipCode', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre code postal'
                ]

            ])
            ->add('city', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre ville'
                ]

            ])
            ->add('country', CountryType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'Votre pays'
                ]

            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'attr' => [
                    'placeHolder' => 'votre téléphone'
                ]

            ])
            // ->add('user')
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer l\'adresse', 'attr' => ['class' => 'col-12 btn btn-primary']]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
