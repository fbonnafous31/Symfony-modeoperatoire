<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        /** @var User */
        $user = $this->getUser();

        if ($user) {
            return $this->redirectToRoute('recettes_show_user', [
                'user' => $user->getId()
            ]);
        }
        return $this->redirectToRoute('recette_index');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminpage()
    {
        return $this->render('admin.html.twig');
    }

    /**
     * @Route("/debug", name="debug")
     */
    public function debugPage()
    {
        return $this->render('debug.html.twig');
    }
}
