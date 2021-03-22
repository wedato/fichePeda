<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="app_home" , methods={"GET"})
     */
    public function index(UserRepository $users)
    {
        return $this->render('home.html.twig'
        );
    }

    /**
     * @Route("/etudiants", name="consulter_etudiants" , methods={"GET"})
     * @param UserRepository $repository
     * @return Response
     */
    public function consult(UserRepository $repository)
    {
        $etudiants = $repository->findByRole("ETUDIANT");

        if($etudiants == []){
            $this->addFlash('error','Il n\'existe aucun étudiant.');
        }

        return $this->render('pagesResponsable/consulter_etudiants.html.twig', [
            'etudiants' => $etudiants
        ]);
    }

    /**
     * @Route("/etudiants/{idEtudiant}", name="consulter_fiche_etudiant")
     * @param UserRepository $repository
     * @param $idEtudiant
     * @return Response
     */
    public function consultFP(UserRepository $repository, /*FicheRepository $ficheRepository,*/ $idEtudiant)
    {
        $etudiant = $repository->findOneBy([
            'id' => $idEtudiant
        ]);

        //$idFiche = $etudiant->getIdFiche();
        //$fiche = $ficheRepository->findOneBy([
        //  'id' = $idFiche
        //]);

        return $this->render('pagesResponsable/consulter_fiche_etudiant.html.twig',[
            'etudiant' => $etudiant,
            /*'fiche' => $fiche*/
        ]);
    }


    /**
     * @Route("/fichesEnAttente", name="liste_fiche_en_attente" , methods={"GET"})
     */
    public function waitToBeAgree(/*FicheRepository $repository*/)
    {
        /*$fiches = $repository->findBy([
            "isAgree" => false
        ]);*/

        return $this->render('pagesResponsable/fiches_attente_validation.html.twig', [
            /*'fiches' => $fiches*/
        ]);
    }

}