<?php

namespace App\Form;

use App\Entity\Logement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix_nuite', NumberType::class, [
                'attr' => ['class' => 'form-control',
                    'placeholder' => 'Prix'
                ],
                'mapped'=>false

            ])
            ->add('TypeLogement', ChoiceType::class,
                [
                    'choices' => [
                        'Maison' => '0',
                        'Appartement' => '1',
                        "Maison d'hôtes" => '2',
                        'Hotel' => '3',

                    ],
                    'choice_attr' => [
                        'Maison' => ['class' => 'radio-control'],
                        'Appartement' => ['class' => 'radio-control'],
                        "Maison d'hôtes" => ['class' => 'radio-control'],
                        'Hotel' => ['class' => 'radio-control'],
                    ],
                    'label' => 'Type du logement proposé',
                    'expanded' => true,
                    'multiple' => false,
                    'mapped' => false,

                ])
            ->add('TypeEspace', ChoiceType::class,
                [
                    'choices' => [
                        'Un logement entier' => '0',
                        'Une chambre privée' => '1',
                        'Une chambre partagée' => '2',
                    ],
                    'choice_attr' => [
                        'Un logement entier' => [
                            'selected' => 'true'
                        ],
                        'label' => "Type de l'espace proposé"
                    ],
                    'mapped' => false,

                ])
            ->add('NumLogement', IntegerType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'id' => 'numero',
                        'min' => 0
                    ]

                ])
            ->add('Rue', TextType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'placeholder' => 'Rue'
                    ]
                ])
            ->add('Ville', TextType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'placeholder' => 'Ville'
                    ]
                ])
            ->add('Pays', CountryType::class,
                [
                    'attr' => ['class' => 'form-control'
                    ]
                ])
            ->add('NbrLits', IntegerType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'min' => 0,
                        'max' => 70]
                ])
            ->add('Nbr_sdb', IntegerType::class, [
                'attr' => ['class' => 'form-control',
                    'min' => 0,
                    'max' => 50]
            ])
            ->add('NbrChambres', IntegerType::class, [
                'attr' => ['class' => 'form-control',
                    'min' => 0,
                    'max' => 60
                ]
            ])
            ->add('Titre', TextType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'placeholder' => "Titre de l'annonce"
                    ]
                ])
            ->add('Description', TextType::class,
                [
                    'attr' => ['class' => 'form-control',
                        'placeholder' => "Description"
                    ]
                ])
            ->add('Equipements', ChoiceType::class,
                [
                    'choices' => [
                        "Wifi" => "wifi",
                        "Télévision" => "television",
                        "Climatisation" => "climatisation",
                        "Chauffage" => "chauffage",
                        "Parking" => "parking",
                        "Cuisine" => "cuisine",
                        "Lave-Linge" => "laveLinge",
                        "Sèche-Linge" => "sècheLinge",
                        "Espace de travail dedié" => "espaceTravail",
                        "Sèche-cheveux" => "sècheCheveux",
                        "Recharge véhicules électriques" => "recharge",
                        "Fer à repasser" => "fer",
                        "Piscine" => "piscine",
                        "Jacuzzi" => "jacuzzi",
                        "Lit pour bébé" => "litBebe",
                        "Salle de sport" => "salleSport",
                        "Barbecue" => "barbecue",
                        "Petit déjeuner" => "petitDej",
                        "Cheminée" => "cheminee",
                        "Détecteur de monoxyde de carbone" => "detectionMonoxyde",
                        "Détection de fumée" => "detectionFumee",
                        "Logement fumeur" => "fumeur",
                        "Bord de mer" => "bordMer",
                        "Front de mer" => "frontMer"
                    ],
                    'choice_attr' => [
                        "Wifi" => ['class' => 'radio-control'],
                        "Télévision" => ['class' => 'radio-control'],
                        "Climatisation" => ['class' => 'radio-control'],
                        "Chauffage" => ['class' => 'radio-control'],
                        "Parking" => ['class' => 'radio-control'],
                        "Cuisine" => ['class' => 'radio-control'],
                        "Lave-Linge" => ['class' => 'radio-control'],
                        "Sèche-Linge" => ['class' => 'radio-control'],
                        "Espace de travail dedié" => ['class' => 'radio-control'],
                        "Sèche-cheveux" => ['class' => 'radio-control'],
                        "Recharge véhicules électriques" => ['class' => 'radio-control'],
                        "Fer à repasser" => ['class' => 'radio-control'],
                        "Piscine" => ['class' => 'radio-control'],
                        "Jacuzzi" => ['class' => 'radio-control'],
                        "Lit pour bébé" => ['class' => 'radio-control'],
                        "Salle de sport" => ['class' => 'radio-control'],
                        "Barbecue" => ['class' => 'radio-control'],
                        "Petit déjeuner" => ['class' => 'radio-control'],
                        "Cheminée" => ['class' => 'radio-control'],
                        "Détecteur de monoxyde de carbone" => ['class' => 'radio-control'],
                        "Détection de fumée" => ['class' => 'radio-control'],
                        "Logement fumeur" => ['class' => 'radio-control'],
                        "Bord de mer" => ['class' => 'radio-control'],
                        "Front de mer" => ['class' => 'radio-control'],
                    ],

                    'expanded' => true,
                    'multiple' => true,
                    'mapped' => false
                ])
            ->add('images', FileType::class,
                ['data_class' => null,

                    'attr' => ['class' => 'form-control',
                        "multiple" => true
                    ],
                    'multiple' => true,
                    'mapped' => false

                ])
            ->add('Valider', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logement::class,
        ]);
    }
}
