<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectTag;
use App\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectTagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('main')
            ->add('project', EntityType::class, [
                'class' => Project::class,
'choice_label' => 'id',
            ])
            ->add('tag', EntityType::class, [
                'class' => Tags::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectTag::class,
        ]);
    }
}
