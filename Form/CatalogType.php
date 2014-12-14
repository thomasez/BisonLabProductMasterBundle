<?php

namespace BisonLab\ProductMasterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifier')
            ->add('name')
            ->add('description', 'text', array('required' => false))
            ->add('originating_from', 'text', array('required' => false))
            ->add('external_id', 'text', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BisonLab\ProductMasterBundle\Entity\Catalog'
        ));
    }

    public function getName()
    {
        return 'bisonlab_productmasterbundle_catalogtype';
    }
}
