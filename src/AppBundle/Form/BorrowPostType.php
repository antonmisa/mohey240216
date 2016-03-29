<?php
/**
 * Created by PhpStorm.
 * User: saveliev.a.m
 * Date: 01.02.2016
 * Time: 14:52
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Form\DataTransformer\MoheyUserToTextTransformer;

class BorrowPostType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offer_id', HiddenType::class)
            ->add('user', TextType::class, array('disabled' => true))
            ->add('price_from', NumberType::class, array('disabled' => true))
            ->add('price_to', NumberType::class, array('disabled' => true))
            ->add('proc_from', NumberType::class, array('disabled' => true))
            ->add('proc_to', NumberType::class, array('disabled' => true))
            ->add('date_from', NumberType::class, array('disabled' => true, 'scale' => 0))
            ->add('date_to', NumberType::class, array('disabled' => true, 'scale' => 0))
        ;
        
        $builder->get('user')
            ->addModelTransformer(new MoheyUserToTextTransformer($this->manager));
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