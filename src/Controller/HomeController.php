<?php


namespace App\Controller;


use App\Form\FichePedaType;
use App\Repository\FichePedaRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="app_home" , methods={"GET"})
     * @param UserRepository $users
     * @return Response
     */
    public function index(UserRepository $users): Response
    {
        return $this->render('home.html.twig'
        );
    }

    /**
     * @Route("/etudiants", name="consulter_etudiants" , methods={"GET"})
     * @Security("is_granted('ROLE_RESPONSABLE')", message="Vous devez être professeur responsable pour accéder à cette page.")
     * @param FichePedaRepository $repository
     * @return Response
     */
    public function consult(FichePedaRepository $repository): Response
    {
        $fiches = $repository->findBy([
            'isAgree' => true
        ]);

        if($fiches == []){
            $this->addFlash('warning','Il n\'existe aucun étudiant dont la fiche est validée.');
        }

        return $this->render('liste_etudiants.twig', [
            'do' => 'consulter',
            'fiches' => $fiches
        ]);
    }

    /**
     * @Route("/etudiants/all", name="consulter_etudiants_all" , methods={"GET"})
     * @Security("is_granted('ROLE_SECRETAIRE')", message="Vous devez être secrétaire pour accéder à cette page.")
     * @param FichePedaRepository $repository
     * @return Response
     */
    public function consultAll(FichePedaRepository $repository): Response
    {
        $fiches = $repository->findAll();

        if($fiches == []){
            $this->addFlash('warning','Il n\'existe aucun étudiant dont la fiche est validée.');
        }

        return $this->render('liste_etudiants.twig', [
            'do' => 'consulter',
            'fiches' => $fiches
        ]);
    }

    /**
     * @Route("/etudiants/edit/{idFiche}", name="consulter_fiche_etudiant")
     * @IsGranted("ROLE_ADMIN" , message="Vous devez être admin pour accéder à cette page")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FichePedaRepository $repository
     * @param UserInterface $user
     * @param $idFiche
     * @return Response
     */
    public function consultFP(Request $request, EntityManagerInterface $em, FichePedaRepository $repository, UserInterface $user, $idFiche): Response
    {
        $fiche = $repository->findOneBy([
            'id' => $idFiche
        ]);

        $form = $this->createForm(FichePedaType::class , $fiche);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if(in_array('RESPONSABLE',$user->getRoles())){
                $fiche->setIsAgree(true);
            }
            else{
                $fiche->setIsAgree(false);
            }
            $em->persist($fiche);
            $em->flush();
            $this->addFlash("success","La fiche pédagogique de ".
                $fiche->getNom().
                " ".
                $fiche->getPrenom().
                " a bien été modifiée."
            );
            return $this->redirectToRoute('consulter_etudiants');
        }
        $formView = $form->createView();

        return $this->render('consulter_fiche_etudiant.html.twig',[
            'formView' => $formView,
            'fiche' => $fiche
        ]);
    }


    /**
     * @Route("/etudiants/{option}", name="search_by", methods={"GET"})
     * @IsGranted("ROLE_ADMIN" , message="Vous devez être admin pour accéder à cette page")
     * @param FichePedaRepository $repository
     * @param $option
     * @return Response
     */
    public function searchingBy(FichePedaRepository $repository, $option): Response
    {
        $fiches = [];

        if($option == 'nom' || $option == 'numEtu' || $option == 'dateNaissance'){
            $fiches = $repository->findBy([
                'isAgree' => true
            ],[
                $option => 'ASC'
            ]);
        }
        elseif ($option == 'rse' || $option == 'redoublantAjac' || $option == 'sem_deja_obtenu' || $option == 'tierTemps'){
            $fiches = $repository->findBy([
                $option => true,
                'isAgree' => true
            ]);
        }

        if($fiches == []){
            $this->addFlash('warning','Il n\'existe aucun étudiant correspondant à votre recherche.');
        }

        return $this->render('liste_etudiants.twig', [
            'do' => 'consulter',
            'fiches' => $fiches
        ]);
    }

    /**
     * @Route("/fichesEnAttente", name="liste_fiche_en_attente" , methods={"GET"})
     * @IsGranted("ROLE_RESPONSABLE" , message="Vous devez être responsable pour accéder à cette page")
     * @param FichePedaRepository $repository
     * @return Response
     */
    public function waitToBeAgree(FichePedaRepository $repository): Response
    {
        $fiches = $repository->findBy([
            "isAgree" => false
        ]);

        if(empty($fiches)){
            $this->addFlash("success","Aucune fiche en attente de validation.");
        }

        return $this->render('liste_etudiants.twig', [
            'do' => 'valider',
            'fiches' => $fiches
        ]);
    }


    /**
     * @Route("/fichesEnAttente/{option}", name="validateSearch_by", methods={"GET"})
     * @IsGranted("ROLE_ADMIN" , message="Vous devez être admin pour accéder à cette page")
     * @param FichePedaRepository $repository
     * @param $option
     * @return Response
     */
    public function validateSearchingBy(FichePedaRepository $repository, $option): Response
    {
        $fiches = [];

        if($option == 'nom' || $option == 'numEtu' || $option == 'dateNaissance'){
            $fiches = $repository->findBy([
                'isAgree' => false
            ],[
                $option => 'ASC'
            ]);
        }
        elseif ($option == 'rse' || $option == 'redoublantAjac' || $option == 'sem_deja_obtenu' || $option == 'tierTemps'){
            $fiches = $repository->findBy([
                $option => true,
                'isAgree' => false
            ]);
        }

        if($fiches == []){
            $this->addFlash('warning','Il n\'existe aucun étudiant correspondant à votre recherche.');
        }

        return $this->render('liste_etudiants.twig', [
            'do' => 'valider',
            'fiches' => $fiches
        ]);
    }


    /**
     * @Route("/fichesEnAttente/valider/{idFiche}", name="valider_fiche_etudiant")
     * @IsGranted("ROLE_RESPONSABLE" , message="Vous devez être responsable pour accéder à cette page")
     * @param Request $request
     * @param FichePedaRepository $repository
     * @param EntityManagerInterface $em
     * @param $idFiche
     * @return Response
     */
    public function valider(Request $request, FichePedaRepository $repository, EntityManagerInterface $em, $idFiche): Response
    {
        $fiche = $repository->findOneBy([
            'id' => $idFiche
        ]);

        $form = $this->createForm(FichePedaType::class , $fiche);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fiche->setIsAgree(true);
            $em->persist($fiche);
            $em->flush();
            $this->addFlash("success", "La fiche pédagogique de " .
                $fiche->getNom() .
                " " .
                $fiche->getPrenom() .
                " a bien été validée."
            );
            return $this->redirectToRoute('liste_fiche_en_attente');
        }
        $formView = $form->createView();

        return $this->render('valider_fiche_etudiant.html.twig',[
            'formView' => $formView,
            'fiche' => $fiche
        ]);
    }


    /**
     * @Route("/remove/{idFiche}", name="delete_FichePeda", methods={"GET"})
     * @IsGranted("ROLE_ADMIN" , message="Vous devez être admin pour accéder à cette page")
     * @param FichePedaRepository $repository
     * @param $idFiche
     * @return RedirectResponse
     */
    public function remove(FichePedaRepository $repository, $idFiche): RedirectResponse
    {
        $entity = $repository->findOneBy([
            'id' => $idFiche
        ]);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($entity);
        $manager->flush();

        return $this->redirectToRoute('consulter_etudiants');
    }

}