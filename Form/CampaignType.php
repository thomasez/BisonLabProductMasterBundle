<?php

namespace BisonLab\ProductMasterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('start_date', 'datetime', array('required' => false))
            ->add('end_date', 'datetime', array('required' => false))
            ->add('price', 'integer', array('required' => false))
            ->add('min_price', 'integer', array('required' => false))
            ->add('rebate_percent', 'integer', array('required' => false))
            ->add('rebate_amount', 'integer', array('required' => false))
            ->add('campaign_period', 'choice', array('choices' => \BisonLab\ProductMasterBundle\Model\BillingPeriod\BillingPeriod::getAvailablePeriods()))
            ->add('campaign_period_amount', 'integer', array('required' => false))
            ->add('binding_period', 'choice', 
                    array(
                        'choices' => \BisonLab\ProductMasterBundle\Model\BillingPeriod\BillingPeriod::getAvailablePeriods(), 
                        'required' => false)
                    )
            ->add('binding_period_amount', 'integer', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BisonLab\ProductMasterBundle\Entity\Campaign'
        ));
    }

    public function getName()
    {
        return 'bisonlab_productmasterbundle_campaigntype';
    }
}
