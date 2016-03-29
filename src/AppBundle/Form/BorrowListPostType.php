<?php
/**
 * Created by PhpStorm.
 * User: Saveliev.A.M
 * Date: 28.01.2016
 * Time: 11:35
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BorrowListPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', HiddenType::class)
            ->add('price', NumberType::class, array('scale' => 2))
            ->add('proc', NumberType::class, array('scale' => 2))
            ->add('date', NumberType::class, array('scale' => 0))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BorrowListSearchForm',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'csrf_token_id'   => 'task_item',
            'attr' => array('id' => 'borrowlist_form')
        ));
    }
}