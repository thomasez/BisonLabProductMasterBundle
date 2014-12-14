<?php

namespace BisonLab\ProductMasterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifier')
            ->add('name', 'text')
            ->add('description', 'text', array('required' => false))
            ->add('long_description', 'textarea', array('required' => false))
            ->add('one_time_price', 'integer', array('required' => false))
            ->add('subscription_price', 'integer', array('required' => false))
            ->add('sale_start', 'datetime', array('required' => false))
            ->add('sale_end', 'datetime', array('required' => false))
            ->add('start_date', 'datetime', array('required' => false))
            ->add('end_date', 'datetime', array('required' => false))
            ->add('product_type', 'choice', array('choices' => \BisonLab\ProductMasterBundle\Entity\Product::getAvailableProductTypes()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BisonLab\ProductMasterBundle\Entity\Product'
        ));
    }

    public function getName()
    {
        return 'bisonlab_productmasterbundle_producttype';
    }
}
