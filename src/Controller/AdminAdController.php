<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads/{page<\d+>?1}", name="admin_ads_index")
     */
    public function index(AdRepository $repo, $page, PaginationService $pagination): Response
    {
       $pagination->setEntityClass(Ad::class)
           ->setPage($page);



        return $this->render('admin/ad/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     *
     * @Route ("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ManagerRegistry $manager){
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $manager->getManager();
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'Success',
                "Les modifs <strong> {$ad->getTitle()}</strong> ok !");
        }



        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);
    }
}
