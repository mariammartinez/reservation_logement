<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, $this->getConfiguration("date d'arrivée", "date d'arrivée", ["widget"=>"single_text"]))
            ->add('endDate', DateType::class, $this->getConfiguration("date de départ", "date de départ",  ["widget"=>"single_text"]))
            ->add('comment', TextType::class, $this->getConfiguration(false, "le comment", [
                "required"=> false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
