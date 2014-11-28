<?php
/**
 * Created by PhpStorm.
 * User: annevialle
 * Date: 25/11/2014
 * Time: 14:50
 */

namespace Cergy\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'required'   => true,
                'max_length' => 100,
                'label'      => 'Titre',
                'error_bubbling' => true
            ])
            ->add('content', 'textarea', [
                'required' => true,
                'label'    => 'Contenu',
                'error_bubbling' => true
            ])
            ->add('author', 'entity', array(
                'class' => 'CergyUserBundle:User',
                'property' => 'username',
                'label' => 'Auteur',
                'error_bubbling' => true
            ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cergy\NewsBundle\Entity\News'
        ]);
    }

    public function getName()
    {
        return 'news_form';
    }
} 