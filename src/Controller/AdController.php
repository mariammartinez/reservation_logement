<?php

namespace App\Controller;
use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     *
     * @param AdRepository $repo
     *
     * @return Response
     */
    public function index(AdRepository $repo): Response
    {

        $repo = $this->getDoctrine()->getRepository(Ad::class);

        $ads = $repo->findAll();


        return $this->render('ad/index.html.twig', [
            'ads'=> $ads
        ]);
    }

    /**
     * Créer une annonce
     *
     * @Route("/ads/new", name= "ads_create")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
        public function create(Request $request, ²ManagerRegistry $managerRegistry){

            $ad = new Ad();

            $form = $this->createForm(Adtype::class, $ad);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager = $managerRegistry->getManager();
                foreach ($ad->getImages() as $image) {
                    $image->setAd($ad);
                    $manager->persist($image);
                }

                $ad->setAuthor($this->getUser());

                $manager = $managerRegistry->getManager();
                $manager->persist($ad);
                $manager->flush();

                $this->addFlash(
                    'Success',
                    "L'annonce {$ad->getTitle()} a bien été enregistrée !"
                );

                return $this->redirectToRoute('ads_show', [
                   'slug'=> $ad->getSlug()
                ]);

            }

            return $this->render('ad/new.html.twig', [
                'form' => $form->createView()
            ]);

        }

     /**
     * Permet d'afficher le form edit
     *
     * @Route("/ads/{slug}/edit", name="ads_edit")
      * @Security("is_granted('ROLE_USER') and user === ad.getAuthor()", message= "pas le droit")
     *
     * @return Response
     *
     */
        public function edit(Ad $ad, Request $request, ManagerRegistry $managerRegistry)
        {
            $form = $this->createForm(Adtype::class, $ad);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager = $managerRegistry->getManager();
                foreach ($ad->getImages() as $image) {
                    $image->setAd($ad);
                    $manager->persist($image);
                }

                $manager = $managerRegistry->getManager();
                $manager->persist($ad);
                $manager->flush();

                $this->addFlash(
                    'Success',
                    "Les modifs {$ad->getTitle()} ont bien été enregistrées !"
                );

                return $this->redirectToRoute('ads_show', [
                    'slug'=> $ad->getSlug()
                ]);

            }


            return $this->render('ad/edit.html.twig',[
                'form' => $form->createView()
        ]);

        }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/ads/{slug}", name= "ads_show")
     *
     * @return Response
     *
     */

    public function show(Ad $ad){

        return $this->render('ad/show.html.twig',[
            'ad' => $ad
            ]);
    }

}
