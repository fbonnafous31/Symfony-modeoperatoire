<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la recette',
                'attr' => [
                    'placeholder' => 'Nom de la recette'
                ]
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée de préparation',
                'attr' => [
                    'placeholder' => 'Durée de préparation'
                ]
            ])
            ->add('difficulte', ChoiceType::class, [
                'label' => 'Niveau de difficulté',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir le niveau de difficulté -- ',
                'choices' => [
                    'Facile'    => 1,
                    'Moyen'     => 2,
                    'Difficile' => 3
                ]
            ])
            ->add('prix', ChoiceType::class, [
                'label' => 'Niveau de prix',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir le niveau de prix -- ',
                'choices' => [
                    'Bon marché' => 1,
                    'Moyen'      => 2,
                    'Assez cher' => 3,
                    'Cher'       => 4
                ]
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
