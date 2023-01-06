<?php

namespace App\Controller;

use App\Repository\CategoriesPrixRepository;
use App\Repository\NiveauDifficulteRepository;
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
    public function create(FormFactoryInterface $factory, CategoriesPrixRepository $categoriesPrixRepository, NiveauDifficulteRepository $niveauDifficulteRepository)
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
            ]);

        $options = [];

        foreach ($niveauDifficulteRepository->findAll() as $niveau) {
            $options[$niveau->getDescription()] = $niveau->getNiveau();
        }

        $builder->add('difficulte', ChoiceType::class, [
            'label' => 'Niveau de difficulté',
            'attr' => ['class' => 'form-control'],
            'placeholder' => '-- Choisir le niveau de difficulté -- ',
            'choices' => $options
        ]);


        $options = [];

        foreach ($categoriesPrixRepository->findAll() as $categorie) {
            $options[$categorie->getDescription()] = $categorie->getCategorie();
        }

        $builder->add('prix', ChoiceType::class, [
            'label' => 'Niveau de prix',
            'attr' => ['class' => 'form-control'],
            'placeholder' => '-- Choisir le niveau de prix -- ',
            'choices' => $options
        ]);

        $form = $builder->getForm();

        $formView = $form->createView();

        return $this->render('recette/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
