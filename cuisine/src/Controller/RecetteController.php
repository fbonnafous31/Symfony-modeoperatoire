<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;

class RecetteController extends AbstractController
{
    /**
     * @Route("/admin/recette/create", name="recette_create")
     */
    public function create(FormFactoryInterface $factory)
    {
        $builder = $factory->createBuilder();

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la recette',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom de la recette'
                ]
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée de préparation',
                'attr' => [
                    'class' => 'form-control',
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
            ]);

        $form = $builder->getForm();

        $formView = $form->createView();

        return $this->render('recette/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
