<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class,[
                'label'=>'Image',
                'attr' => array('accept'=>'.jpg,.jpeg', 'id' =>'customFile', 'class'=>'btn btn-success'),
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
            ->add('ville', EntityType::class,[
                'label'=>'Ville',
                'attr'=>['id'=>'inputVille', 'class'=>'custom-select'],
                'class'=> Ville::class,
                'choice_label'=>'nom',
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
            'data_class' => Photo::class,
        ]);
    }
}
