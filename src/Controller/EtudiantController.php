<?php

namespace App\Controller;

use App\Entity\FichePeda;
use App\Event\FicheCreateEvent;
use App\Form\FichePedaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route ("/creerFichePeda" , name="creation_fiche")
     * @IsGranted("ROLE_USER" , message="Vous devez être connecté pour accéder à cette page")
     * @param FormFactoryInterface $factory
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function creerFichePeda(FormFactoryInterface $factory , Request $request , EntityManagerInterface $em , EventDispatcherInterface $dispatcher)
    {
        $fichePeda = new FichePeda();
        $form = $this->createForm(FichePedaType::class , $fichePeda);





       $form->getData()->setisAgree(false);

        $form->handleRequest($request);

//        dd($form);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($fichePeda);
            $em->flush();
            $dispatcher->dispatch(new FicheCreateEvent($fichePeda) , 'fiche_create');
            return $this->redirectToRoute('app_home');
        }
        $formView = $form->createView();

        return $this->render('etudiant/creerFichePeda.html.twig' , [
            'formView' => $formView
        ]);
    }
}
