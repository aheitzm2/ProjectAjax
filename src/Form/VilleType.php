<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'Nom',
                'attr' => ['class' => 'form-control form-control-lg', 'id'=>'inputNom'],
                'required'=>true
            ])
            ->add('latitude',NumberType::class,[
                'label' => 'Latitude',
                'attr' => ['class' => 'form-control form-control-lg', 'id'=>'inputLat'],
                'required'=>true
            ])
            ->add('longitude',NumberType::class,[
                'label' => 'Longitude',
                'attr' => ['class' => 'form-control form-control-lg', 'id'=>'inputLong'],
                'required'=>true
            ])
            ->add('submit',SubmitType::class,[
                'label' => 'Valider',
                'attr' => ['class' => 'btn btn-outline-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
