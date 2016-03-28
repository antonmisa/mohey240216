<?php
/**
 * Created by PhpStorm.
 * User: saveliev.a.m
 * Date: 01.02.2016
 * Time: 14:52
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BorrowPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offer_id', HiddenType::class)
            ->add('user', EntityType::class, array('class' => 'AppBundle:MoheyUser', 'choice_label' => 'user_name', 'disabled' => true))
            ->add('price_from', NumberType::class, array('disabled' => true))
            ->add('price_to', NumberType::class, array('disabled' => true))
            ->add('proc_from', NumberType::class, array('disabled' => true))
            ->add('proc_to', NumberType::class, array('disabled' => true))
            ->add('date_from', NumberType::class, array('disabled' => true, 'scale' => 0))
            ->add('date_to', NumberType::class, array('disabled' => true, 'scale' => 0))
            ->add('save', SubmitType::class)
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