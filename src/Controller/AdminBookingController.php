<?php

namespace App\Controller;
use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use App\Service\PaginationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_bookings_index")
     */
    public function index(BookingRepository $repo, PaginationService $pagination, $page): Response
    {
        $pagination->setEntityClass(Booking::class)
            ->setPage($page);

        return $this->render('admin/booking/index.html.twig', [
           'pagination' => $pagination
        ]);
    }

    /**
     *
     * @Route("/admin/bookings/{id}/edit", name="admin_bookings_edit")
     *
     * @return Response
     *
     */
    public function edit(Booking $booking, Request $request, ManagerRegistry $manager){
        $form = $this->createForm(AdminBookingType::class, $booking );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $booking->setAmount(0);

            $manager = $manager->getManager();
            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'Success',
                "Les modifs ok !");
        }

        return $this->render('admin/booking/edit.html.twig', [
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }


    /**
     *
     * @Route ("/admin/bookings/{id}/delete", name="admin_bookings_delete")
     *
     * @return Response
     */
    public function delete(Booking $booking, ManagerRegistry $manager){

        $manager = $manager->getManager();
        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            'Success',
            " ok !"
        );
        return $this->redirectToRoute("admin_bookings_index");
    }
}
