<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\SearchFilters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchFiltersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categories',EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'expanded' => true,

            ])
            ->add('submit', SubmitType::class, ['label' => 'Filtrer','attr'=>['class'=>'col-12 btn btn-primary']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => SearchFilters::class,
        ]);
    }
}
