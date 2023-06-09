<?php

namespace App\Controller;

use App\Entity\Ustensile;
use App\Form\UstensileType;
use App\Repository\UstensileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ustensile")
 */
class UstensileController extends AbstractController
{
    /**
     * @Route("/", name="ustensile_index", methods={"GET"})
     */
    public function index(UstensileRepository $ustensileRepository): Response
    {
        return $this->render('ustensile/index.html.twig', [
            'ustensiles' => $ustensileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ustensile_create", methods={"GET", "POST"})
     */
    public function create(Request $request, UstensileRepository $ustensileRepository): Response
    {
        $ustensile = new Ustensile();
        $form = $this->createForm(UstensileType::class, $ustensile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ustensileRepository->add($ustensile, true);

            return $this->redirectToRoute('ustensile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ustensile/new.html.twig', [
            'ustensile' => $ustensile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ustensile_show", methods={"GET"})
     */
    public function show(Ustensile $ustensile): Response
    {
        return $this->render('ustensile/show.html.twig', [
            'ustensile' => $ustensile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ustensile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ustensile $ustensile, UstensileRepository $ustensileRepository): Response
    {
        $form = $this->createForm(UstensileType::class, $ustensile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ustensileRepository->add($ustensile, true);

            return $this->redirectToRoute('ustensile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ustensile/edit.html.twig', [
            'ustensile' => $ustensile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ustensile_delete", methods={"POST"})
     */
    public function delete(Request $request, Ustensile $ustensile, UstensileRepository $ustensileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ustensile->getId(), $request->request->get('_token'))) {
            $ustensileRepository->remove($ustensile, true);
        }

        return $this->redirectToRoute('ustensile_index', [], Response::HTTP_SEE_OTHER);
    }
}
