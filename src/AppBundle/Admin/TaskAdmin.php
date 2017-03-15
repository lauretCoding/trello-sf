<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskAdmin extends AbstractAdmin
{
    public $supportsPreviewMode = true;

    public function toString($object)
    {
        return $object instanceof Task
            ? $object->getName()
            : 'Task';
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Contenu', array('class' => 'col-md-9'))
                ->add('name', TextType::class)
                ->add('description', TextareaType::class)
                ->add('status', ChoiceType::class , [
                    'choices'  => [
                        Task::STATUS_OPEN => Task::STATUS_OPEN,
                        Task::STATUS_CLOSED => Task::STATUS_CLOSED,
                    ]
                ])
            ->end()
            ->with('Category', array('class' => 'col-md-3'))
                ->add('category', 'sonata_type_model', [
                    'class' => 'AppBundle:Category',
                    'property' => 'name',
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('category', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Category',
                'choice_label' => 'name',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('category.name')
        ;
    }
}