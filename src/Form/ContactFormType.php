<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un prénom'
                    ])
                ],
                'required' => true,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'John',
                    'class' => 'form-firstname form-input'
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom'
                    ])
                ],
                'required' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Doe',
                    'class' => 'form-lastname form-input'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email'
                    ])
                ],
                'required' => true,
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'john@doe.com',
                    'class' => 'form-email form-input'
                ]

            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => '06 12 34 56 78',
                    'class' => 'form-phone form-input'
                ],
            ])
            ->add('topic', ChoiceType::class, [
                'choices' => [
                    'Question' => 'Question',
                    'Suggestion' => 'Suggestion',
                    'Bug report' => 'Bug report',
                    'Travailler avec vous' => 'Travailler avec vous',
                    'Autre' => 'Autre'
                ],
                'label' => 'Sujet de votre message',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un sujet'
                    ])
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-topic'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                    'cols' => 50,
                    'placeholder' => 'Votre message ici...',
                    'class' => 'form-message'
                ],
                'label' => 'Votre message',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un message'
                    ])
                ]
            ])
            ->add('terms', CheckboxType::class, [
                'label' => 'J\'accepte que mes données soient utilisées pour me recontacter',
                'required' => true,
                'attr' => [
                    'class' => 'form-checkbox'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
