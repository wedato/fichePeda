<?php

namespace App\Form;

use App\Entity\FichePeda;
use Symfony\Component\Form\AbstractType;
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
            ->add('redoublantAjac')
            ->add('semDejaObtenu')
            ->add('tierTemps')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FichePeda::class,
        ]);
    }
}
