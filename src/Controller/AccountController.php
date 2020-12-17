<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     *
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout(){

    }

    /**
     *
     * @Route("/register", name="account_register")
     *
     * @return Response
     */
    public function register(Request $request, ManagerRegistry $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager = $manager->getManager();
            $manager->persist($user);
           $manager->flush();

           $this->addFlash(
               'success',
               'votre compte à été créé! vous pouvez vous connecter'
           );

           return $this->redirectToRoute('account_login');
        }

        return $this->render('/account/registration.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Permet d'afficher et traiter le form de modif de profil
     *
     * @Route("account/profile", name="account_profile")
     *
     * @return Response
     */
    public function profile(Request $request, ManagerRegistry $manager){
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $manager->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'sucess',
                "les modifications ont bien été enregistrés"

            );
        }
        return $this->render('account/profile.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * Modifier le mot de passe
     *
     * @Route("/account/update-password", name="account_password")
     *
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ManagerRegistry $manager) {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form= $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //verifier le old password
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash())) {
                //gerer
                $form ->get('oldPassword')->addError(new FormError("le mot de passe nest pas bon"));

            }else{
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setHash($hash);

                $manager = $manager->getManager();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'sucess',
                    "les modifications ont bien été enregistrés"

                );

                return $this->redirectToRoute(('hello'));
            }

        }

        return $this->render('/account/password.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * Afficher le profil
     *
     *@Route("/account", name="account_index")
     *
     * @return Response
     *
     */
    public function myAccount(){
        return $this->render('user/book.html.twig',[
           'user'=> $this->getUser()
        ]);
    }

}
