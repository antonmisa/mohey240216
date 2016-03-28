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

class BorrowPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', HiddenType::class)
            ->add('price_from', HiddenType::class)
            ->add('price_to', HiddenType::class)
            ->add('proc_from', HiddenType::class)
            ->add('proc_to', HiddenType::class)
            ->add('date_from', HiddenType::class)
            ->add('date_to', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MoheyOffer',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'csrf_token_id'   => 'task_item',
        ));
    }
}