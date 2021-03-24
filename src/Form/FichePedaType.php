<?php

namespace App\Form;

use App\Entity\FichePeda;
use App\Entity\UE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichePedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numEtu')
            ->add('dateNaissance')
            ->add('adressePostal')
            ->add('numTel')
            ->add('numPortable')
            ->add('mail')
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
