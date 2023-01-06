<?php

namespace App\Controller;

use App\Entity\CategoriesPrix;
use App\Entity\NiveauDifficulte;
use App\Repository\CategoriesPrixRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('difficulte', EntityType::class, [
                'label' => 'Niveau de difficulté',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir le niveau de difficulté -- ',
                'class' => NiveauDifficulte::class,
                'choice_label' => 'description'
            ])
            ->add('prix', EntityType::class, [
                'label' => 'Niveau de prix',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir le niveau de prix -- ',
                'class' => CategoriesPrix::class,
                'choice_label' => function (CategoriesPrix $categorie) {
                    return strtoupper($categorie->getDescription());
                }
            ]);

        $form = $builder->getForm();

        $formView = $form->createView();

        return $this->render('recette/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
