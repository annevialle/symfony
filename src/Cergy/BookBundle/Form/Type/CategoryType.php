<?php
/**
 * Created by PhpStorm.
 * User: annevialle
 * Date: 27/11/2014
 * Time: 15:18
 */

namespace Cergy\BookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'required'   => true,
                'max_length' => 100,
                'label'      => 'Libellé',
                'error_bubbling' => true
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cergy\BookBundle\Entity\Category'
        ]);
    }

    function getName()
    {
        return 'category_form';
    }
} 