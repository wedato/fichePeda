<?php


namespace App\Controller;


use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    public const LAST_EMAIL = 'app_login_form_last_email';


    /**
     * @Route("/register", name="app_register" , methods={"GET","POST"})
     */
    public function register(Request $request , UserPasswordEncoderInterface $passwordEncoder , EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $plainPassword = $form->get('plainPassword')->getData();


            $user->setPassword($passwordEncoder->encodePassword($user,$plainPassword));
            $em->persist($user);
            $em->flush();
            $this->addFlash('success' , 'User successfully created !');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('security/register.html.twig' , [
            'registrationForm' => $form->createView()
        ]);

    }



    /**
     * @Route("/login", name="app_login" , methods={"GET","POST"})
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig');

    }

    /**
     * @Route("/logout" , name="app_logout" , methods={"GET"} )
     */
    public function logout()
    {

    }
}