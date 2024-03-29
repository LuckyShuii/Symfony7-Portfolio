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
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-firstname form-input js-input'
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom'
                    ])
                ],
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-lastname form-input js-input'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email'
                    ])
                ],
                'label' => 'Adresse email',
                'attr' => [
                    'class' => 'form-email form-input js-input'
                ]

            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'class' => 'form-phone form-input js-input'
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
                'attr' => [
                    'class' => 'js-input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un sujet'
                    ])
                ],
                'attr' => [
                    'class' => 'form-topic'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                    'cols' => 50,
                    'class' => 'form-message js-input'
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
                'label_attr' => [
                    'class' => 'labelMod'
                ],
                'attr' => [
                    'class' => 'form-checkbox js-input'
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
