<?php

namespace BisonLab\ProductMasterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductCampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_selectable', 'checkbox', array('required' => false))
            ->add('description', 'textarea', array('required' => false))
            ->add('product')
            ->add('campaign')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BisonLab\ProductMasterBundle\Entity\ProductCampaign'
        ));
    }

    public function getName()
    {
        return 'bisonlab_productmasterbundle_productcampaigntype';
    }
}
