<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom',null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est obligatoire!',
                    ]),
                ],
            ])
            ->add('Prenom',null,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le Prénom est obligatoire!',
                    ]),
                ],

            ])
            ->add('email',null,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un email valide!',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un Mot de Passe!',
                    ]),
                  ],

            ])
            ->add('Telephone' ,null ,[
                'constraints' => [
        new NotBlank([
            'message' => 'Entrez votre numero de Telephone!',
        ])
            ],])
            ->add('Age',null,[

                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre âge!',
                    ]),
                    new GreaterThanOrEqual([
                        'value'=>'18',
                        'message'=>'vous devez avoir au moins 18 ans',
                        ])
                ],
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
