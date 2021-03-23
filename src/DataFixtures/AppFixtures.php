<?php

namespace App\DataFixtures;

use App\Entity\UE;
use App\Entity\User;
use App\Enum\UserTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        $admin = new User();

        $hash = $this->encoder->encodePassword($admin, "password");

        $admin->setEmail("admin@gmail.com")
            ->setPassword($hash)
            ->setUsername("Admin")
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        $responsable = new User();

        $hash = $this->encoder->encodePassword($admin, "password");

        $responsable->setEmail("responsable@gmail.com")
            ->setPassword($hash)
            ->setUsername("Responsable")
            ->setRoles(['ROLE_ADMIN', 'RESPONSABLE']);

        $manager->persist($responsable);

        $secretaire = new User();
        $secretaire->setEmail("secretaire@gmail.com")
            ->setPassword($hash)
            ->setUsername("Secretaire")
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($secretaire);


        for ($u = 0; $u < 5 ; $u++) {
            $user = new User();
            $hash = $this->encoder->encodePassword($user,"password");
            $user->setEmail("user$u@gmail.com")
                ->setUsername($faker->name())
                ->setPassword($hash)
                ->setRoles(['ETUDIANT']);

            $manager->persist($user);
        }

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF03")
            ->setType("OBL")
            ->setLibelle("Mise à niveau")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(0);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5MT01")
            ->setType("OBL")
            ->setLibelle("Statistiques")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5AG11")
            ->setType("OBL")
            ->setLibelle("Système d’information")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(4);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF04")
            ->setType("OBL")
            ->setLibelle("Programmation avancée ")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(5);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF01")
            ->setType("OBL")
            ->setLibelle("Réseaux")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(5);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5SE01")
            ->setType("OBL")
            ->setLibelle("Gestion comptable")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5AG10")
            ->setType("OBL")
            ->setLibelle("Tech. de communication")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IFAG")
            ->setType("OBL")
            ->setLibelle("Anglais")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF05")
            ->setType("OBL")
            ->setLibelle("Projet informatique")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(2);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5PP01")
            ->setType("OBL")
            ->setLibelle("Projet professionnel")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(2);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF01")
            ->setType("OBL")
            ->setLibelle("Framework web")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(4);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF02")
            ->setType("OBL")
            ->setLibelle("Recherche opérationnelle")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF03")
            ->setType("OBL")
            ->setLibelle("Programmation N Tiers")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(5);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF04")
            ->setType("OBL")
            ->setLibelle("Projet informatique 2")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6SE01")
            ->setType("OBL")
            ->setLibelle("Droit")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6SE02")
            ->setType("OBL")
            ->setLibelle("Environnement économique")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6ST02")
            ->setType("OBL")
            ->setLibelle("Stage ou projet fin d’études ")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(6);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF07")
            ->setType("OBL")
            ->setLibelle("Prog impérative et objet")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(6);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5PP01")
            ->setType("OBL")
            ->setLibelle("Projet perso et pro")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(2);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF09")
            ->setType("OBL")
            ->setLibelle("Analyse des algorithmes")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(4);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF02")
            ->setType("OBL")
            ->setLibelle("Conception orientée objet")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF10")
            ->setType("OBL")
            ->setLibelle("Langage et automate")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(4);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA5IF08")
            ->setType("OBL")
            ->setLibelle("Logique")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF05")
            ->setType("OBL")
            ->setLibelle("Langages algébriques")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);

        $ue = new UE();
        $ue->setCodeApogee("SLA6IF06")
            ->setType("OBL")
            ->setLibelle("Programmation logique")
            ->setInscription(true)
            ->setValideNote("")
            ->setECTS(3);
        $manager->persist($ue);


        $manager->flush();
    }
}
