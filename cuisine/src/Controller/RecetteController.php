<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoriesPrixRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NiveauDifficulteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/recette")
 */

class RecetteController extends AbstractController
{

    /**
     * @Route("/all", name="recette_index")
     */
    public function index(RecetteRepository $recetteRepository)
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findBy(array(), array('nom' => 'ASC')),
        ]);
    }

    /**
     * @Route("/show/{id}", name="recette_show")
     */
    public function show($id, RecetteRepository $recetteRepository, NiveauDifficulteRepository $niveauDifficulteRepository, CategoriesPrixRepository $categoriesPrixRepository)
    {
        $recette = $recetteRepository->find($id);

        $niveau = $niveauDifficulteRepository->findOneBy(['niveau' => $recette->getdifficulte()])->getDescription();

        $prix = $categoriesPrixRepository->findOneBy(['categorie' => $recette->getprix()])->getDescription();

        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
            'niveau'  => $niveau,
            'prix'    => $prix
        ]);
    }

    /**
     * @Route("/chef/{user}", name="recettes_show_user")
     */
    public function show_user($user, RecetteRepository $recetteRepository)
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findBy(array('user' => $user), array('nom' => 'ASC')),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recette_edit")
     */
    public function edit($id, RecetteRepository $recetteRepository, Request $request, EntityManagerInterface $em)
    {
        if (is_null($this->getUser())) {
            return $this->redirectToRoute('app_login');
        }

        $recette = $recetteRepository->find($id);

        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();
            $this->addFlash('success', "Recette modifiée");
            return $this->redirectToRoute('recette_index');
        }

        $formView = $form->createView();

        return $this->render('recette/edit.html.twig', [
            'recette'  => $recette,
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/create", name="recette_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        if (is_null($this->getUser())) {
            return $this->redirectToRoute('app_login');
        }

        $recette = new Recette;

        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recette->setUser($this->getUser());
            dd($recette);

            foreach ($recette->getEtapes() as $etape) {
                $etape->setRecette($recette);
                $em->persist($etape);
                $recette->addEtape($etape);
            }
            $em->persist($recette);
            $em->flush();

            $this->addFlash('success', "Recette créée");
            return $this->redirectToRoute('recette_index');
        }

        $formView = $form->createView();

        return $this->render('recette/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
