<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDebut',DateType::class,[
                'widget' => 'single_text',
                'attr'=>['class' => 'system' ]
            ])
            ->add('DateFin',DateType::class,[
                'widget' => 'single_text',
                'attr'=>['class' => 'system' ]
            ])
            ->add('Reserver',SubmitType::class,[
                'attr'=>['class'=>'btn btn-danger bouton',
                    'disabled'=>true
                    ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
