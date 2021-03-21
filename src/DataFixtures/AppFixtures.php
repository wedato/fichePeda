<?php

namespace App\DataFixtures;

use App\Entity\User;
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
                ->setPassword($hash);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
