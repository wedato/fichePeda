<?php

namespace App\Form;

use App\Entity\FichePeda;
use App\Entity\UE;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichePedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom' , TextType::class , [
                'label' => "Nom de famille",
                'attr' => ['placeholder' => "Nom de famille de l'étudiant"],
                'required' => false

            ])

            ->add('prenom' , TextType::class , [
                'label' => "Prénom",
                'attr' => ['placeholder' => "Prénom de l'étudiant"],
                'required' => false

            ])
            ->add('numEtu' , NumberType::class , [
                'label' => "Numéro étudiant",
                'attr' => ['placeholder' => "Numéro étudiant "],
                'invalid_message' => "Seulement des chiffres svp",
                'required' => false

            ] )
            ->add('dateNaissance' , BirthdayType::class , [
                'label' => "Date de naissance",
                'format' => 'dd-MM-yyyy'


            ])
            ->add('adressePostal' , TextType::class , [
                'label' => "Adresse postal",
                'attr' => ['placeholder' => "Adresse postal de l'étudiant"],
                'required' => false

            ] )
            ->add('numTel' , TextType::class , [
                'label' => "Numéro de telephone ",
                'attr' => ['placeholder' => "Numéro de téléphone fixe de l'étudiant"],
                'required' => false

            ] )
            ->add('numPortable' , TextType::class , [
                'label' => "Numéro de Portable",
                'attr' => ['placeholder' => "Numéro de portable de l'étudiant"],
                'required' => false

            ] )
            ->add('mail' , EmailType::class , [
                'label' => "Numéro étudiant",
                'attr' => ['placeholder' => "Adresse mail de l'étudiant"],
                'required' => false

            ] )
            ->add('rse')
            ->add('typeControlTerminalRse')
            ->add('redoublantAjac' )
            ->add('semDejaObtenu', CheckboxType::class,[
                'required' => false
            ])
            ->add('tierTemps')
            ->add('UEs' , EntityType::class ,[
                'class' => UE::class,
                'choice_label' =>  'libelle',
                'label' => 'Ues',
                'expanded' => true,
                'multiple' => true,


            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FichePeda::class,
        ]);
    }
}
