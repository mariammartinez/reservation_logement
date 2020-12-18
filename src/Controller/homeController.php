<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController{
    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="bonjour_solo")
     *
     * Montrer la page
     *
     * @return Response
     */
    public function hello($prenom = "nada", $age=10){
        return $this->render(
            'nuevo.html.twig',
        [
            'prenom' => $prenom,
            'age'=> $age
        ]
        );
    }
    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $jours = ["lundi"=>7, "mardi"=>8, "samedi"=>12];

      return $this->render(
          'hello.html.twig',
          ['title' => "buenos dias!",
              'coco' => 'amigo',
              'age' => '18',
              'tableau' => $jours
          ]
      );
    }
}

?>