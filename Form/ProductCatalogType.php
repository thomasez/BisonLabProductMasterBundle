<?php

namespace BisonLab\ProductMasterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductCatalogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('external_product_id')
            ->add('external_product_name', 'text', array('required'=>false))
            ->add('external_product_description', 'textarea', array('required'=>false))
            ->add('product')
            ->add('catalog', 'entity', array('class' =>'BisonLabProductMasterBundle:Catalog'))
/*
            ->add('product', 'hidden')
            ->add('catalog', 'entity', array('class' =>'BisonLabProductMasterBundle:Catalog')
    'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.username', 'ASC');
)
*/
            // ->add('catalog', 'choice', array('choices' => $options['data']->getAvailableCatalogsAsStringList()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BisonLab\ProductMasterBundle\Entity\ProductCatalog'
        ));
    }

    public function getName()
    {
        return 'bisonlab_productmasterbundle_productcatalogtype';
    }
}
