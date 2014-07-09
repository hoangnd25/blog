<?php

namespace App\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TagAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('posts','sonata_type_model', array(
                'required' => false,
                'multiple' => true,
                'by_reference' => false,
                'attr' => array('class' => 'form-control')
            ))
//            ->add('canonicalName')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
//            ->add('canonicalName')
//            ->add('author')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('canonicalName')
            ->add('name')
            ->add('count', 'string', array('label' => 'Total posts', 'template' => 'AppBlogBundle:Admin:list_tag_post_count.html.twig'))
//            ->add('slug')
//            ->add('author')
        ;
    }
}