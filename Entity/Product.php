<?php

namespace BisonLab\ProductMasterBundle\Entity;
use BisonLab\ProductMasterBundle\Entity\Base as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * BisonLab\ProductMasterBundle\Entity\Product
 *
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductRepository")
 *
 */
class Product extends Base\Product
{

    protected static $available_product_types = array(
        'subscription' => 'Subscription', 
        'physical' => 'Physical', 
        'one_time_charge' => 'One time charge', 
        'subscription_with_otc' => 'Subscrption with one time charge'
        );

    public static function getAvailableProductTypes()
    {
        return self::$available_product_types;
    }

    public function __toString()
    {
        return (string)$this->getName();
    }

}
