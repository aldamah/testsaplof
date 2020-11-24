<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TO DO: le class
        $builder->add('description', TextType::class, [
            'label' => 'Description',
        ])
        ->add('dateDebut', DateType::class,[
    // renders it as a single text box
    'widget' => 'single_text',
])
        ->add('dateFin', DateType::class,[
    // renders it as a single text box
    'widget' => 'single_text',
])
        ->add('evolution', TextType::class)
        ->add('observation', TextType::class, [
            'label' => 'Observation',
        ])
        ->add('save', SubmitType::class, ['label' => 'Create Task']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
