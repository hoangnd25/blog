<?php

namespace App\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'created' // field name
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Post Title'))
            ->add('published', null)
//            ->add('author', 'entity', array('class' => 'Acme\DemoBundle\Entity\User'))
            ->add('intro','ckeditor',array(
                'toolbar'                      => array('document','basicstyles', 'paragraph', 'links', 'insert'),
            ))
            ->add('body','ckeditor') //if no type is specified, SonataAdminBundle tries to guess it
            ->add('tags','sonata_type_model', array(
                'required' => false,
                'multiple' => true,
                'by_reference' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('seoMetadata','seo_metadata')
            ->add('created')
            ->add('updated')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('published')
//            ->add('author')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('published')
            ->add('tags')
            ->add('created')
            ->add('updated')
//            ->add('slug')
//            ->add('author')
        ;
    }
}