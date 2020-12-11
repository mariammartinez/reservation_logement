<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * Permet d'avoir la conf de base d'un champs
     *
     * @param $label
     * @param $placeholder
     * @param array $options
     * @return array
     */

    private function getConfiguration($label, $placeholder, $options = []){
        return array_merge([
                'label' => $label,
                'attr' => [ 'placeholder'=> $placeholder
                ]
            ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration("titre", "Ici votre annonce")
            )
            ->add(
                'slug',
                TextType::class,
                $this->getConfiguration("web", "automatique", [
                    'required'=> false
                ])
            )
            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration("Intro", "Ici votre intro")
            )
            ->add(
                'content',
                TextareaType::class,
                $this->getConfiguration("Description", "Ici la description")
            )
            ->add(
                'coverImage',
                UrlType::class,
                $this->getConfiguration("L'Url de l'image", "Ici l'URL")
            )
            ->add(
                'price',
                MoneyType::class,
                $this->getConfiguration("Le prix", "Ici le prix")
            )
            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration("Nombre de chambres", "les chambres")
            )
            ->add(
                'images',
                CollectionType::class, [
                    'entry_type'=> ImageType::class,
                    'allow_add' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
