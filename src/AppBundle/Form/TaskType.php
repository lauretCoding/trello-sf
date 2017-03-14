<?php

namespace AppBundle\Form;

use AppBundle\Controller\TaskController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Task;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
                ->add('description', TextType::class)
                ->add('status', ChoiceType::class , [
                    'choices'  => [
                        Task::STATUS_OPEN => Task::STATUS_OPEN,
                        Task::STATUS_CLOSED => Task::STATUS_CLOSED,
                    ]
                ])
                ->add('category', EntityType::class, [
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name',
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_task';
    }


}
