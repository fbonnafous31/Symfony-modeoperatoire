<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/test/{id?0}", name="test", requirements={"id":"\d+"})
     */
    public function test($id)
    {
        var_dump("Validation du système d'annotations, id = $id");
        die;
    }
}
