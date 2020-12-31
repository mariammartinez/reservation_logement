<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\UserRepository;
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
    public function home(AdRepository $adRepo, UserRepository $userRepo){
      return $this->render(
          'hello.html.twig',[
              'ads' =>$adRepo->findBestAds(3),
              'users' => $userRepo->findBestUsers()
          ]
      );
    }
}

?>