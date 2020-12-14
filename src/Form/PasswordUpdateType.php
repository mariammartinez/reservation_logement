<?php

namespace App\Form;

use Symfony\Component\Form\App;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUpdateType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, $this->getConfiguration("ancien mot de passe", "ancien"))
            ->add('newPassword', PasswordType::class, $this->getConfiguration("nouveau mot de passe", "nouveau"))
            ->add('confirmPassword', PasswordType::class, $this->getConfiguration("confirmation", 'confirmation'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
