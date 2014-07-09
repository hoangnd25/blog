<?php

namespace App\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use App\UserBundle\Entity\History;

class HistoryAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('current',null,array('required'=>false))
            ->add('type','choice',array(
                'choices' => array(
                    History::EDUCATION => History::EDUCATION,
                    History::WORK => History::WORK,
                )
            ))
            ->add('year')
            ->add('at')
            ->add('description')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('type')
            ->add('year')
            ->add('at')
            ->add('current')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('type')
            ->add('year')
            ->add('at')
            ->add('current')
        ;
    }
}