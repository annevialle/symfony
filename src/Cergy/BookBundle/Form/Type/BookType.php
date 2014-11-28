<?php
/**
 * Created by PhpStorm.
 * User: annevialle
 * Date: 27/11/2014
 * Time: 14:13
 */

namespace Cergy\BookBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'required'   => true,
                'max_length' => 100,
                'label'      => 'Nom',
                'error_bubbling' => true
            ])
            ->add('releaseDate', 'date', [
                'required' => true,
                'label' => 'Date de parution',
                'error_bubbling' => true
            ])
            ->add('description', 'textarea', [
                'required' => true,
                'label' => 'Description',
                'error_bubbling' => true
            ])
            ->add('price', 'text', [
                'required' => true,
                'label' => 'Prix',
                'error_bubbling' => true
            ])
            ->add('author', 'entity', array(
                'class' => 'CergyUserBundle:User',
                'property' => 'username',
                'label' => 'Auteur',
                'error_bubbling' => true
            ))
            ->add('category', 'entity', array(
                'class' => 'CergyBookBundle:Category',
                'property' => 'name',
                'label' => 'Catégorie',
                'error_bubbling' => true
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cergy\BookBundle\Entity\Book'
        ]);
    }

    function getName()
    {
        return 'book_form';
    }
}