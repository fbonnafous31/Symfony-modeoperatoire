<?php

namespace App\Controller\Recette;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Event\RecetteSuccessEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FabriqueRecetteController extends AbstractController
{
    /**
     * @Route("/recette/create", name="recette_create")
     */
    public function create(Request $request, EntityManagerInterface $em, EventDispatcherInterface $dispatcher)
    {
        /** @var User */
        $currentUser = $this->getUser();

        if (is_null($this->getUser())) {
            return $this->redirectToRoute('app_login');
        }

        $recette = new Recette;

        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recette->setUser($this->getUser());

            foreach ($recette->getEtapes() as $etape) {
                $etape->setRecette($recette);
                $em->persist($etape);
                $recette->addEtape($etape);
            }

            foreach ($recette->getIngredients() as $ingredient) {
                $ingredient->setRecette($recette);
                $em->persist($ingredient);
                $recette->addIngredient($ingredient);
            }

            $em->persist($recette);
            $em->flush();

            $dispatcher->dispatch(new RecetteSuccessEvent($recette), 'recette.success');

            $this->addFlash('success', "Recette créée");
            return $this->redirectToRoute('recettes_show_user', [
                'user' => $currentUser->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('recette/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
