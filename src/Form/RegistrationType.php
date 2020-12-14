<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationType extends ApplicationType

{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fisrtName', TextType::class, $this->getConfiguration("Prénom", "votre prénom"))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom"))
            ->add('email', EmailType::class, $this->getConfiguration("email", "email"))
            ->add('picture', UrlType::class, $this->getConfiguration("photo", "Url de votre avatar"))
            ->add('hash', PasswordType::class, $this->getConfiguration("password", "password"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("confirmation de mot de passe", "confirmer votre mot de passe"))
            ->add('introduction', TextType::class, $this->getConfiguration("introduction", "como estas?"))
            ->add('description', TextareaType::class, $this->getConfiguration("description", "hola"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
