<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is a many to many relation between a product and an owner.
 * Why can there be more than one owner?
 * Well, it can be connected to a department, person, company and so on.
 * Even based on roles. (Which I am not implementing yet.)
 *
 * BisonLab\ProductMasterBundle\Entity\ProductOwner
 *
 * @ORM\Table(name="product_owner")
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductOwnerRepository")
 */
abstract class ProductOwner
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var mixed
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", inversedBy="product_owners")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    private $product;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Owner", inversedBy="product_owners")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     /* Should be an enum, 
     * @ORM\Column(name="type", type="text", nullable=true) 
     */
    protected $type;

    /**
     * Yes, this is also in ProductAccount. But you can decide where 
     * cost shall be distributed, if at all.
     * This is for cost/revenue distribution. A percentage.
     * @ORM\Column(name="percentage", type="int", nullable=true) 
     */
    protected $percentage;

    /**
     * This is for cost/revenue distribution, as a set sum.
     * @ORM\Column(name="amount", type="int", nullable=true) 
     */
    protected $amount;

    public function __construct() {
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user_selectable
     *
     * @param boolean $userSelectable
     */
    public function setUserSelectable($userSelectable)
    {
        $this->user_selectable = $userSelectable;
    }

    /**
     * Get user_selectable
     *
     * @return boolean 
     */
    public function getUserSelectable()
    {
        return $this->user_selectable;
    }

    /**
     * Set product
     *
     * @param object $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return object 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set owner
     *
     * @param object $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return object 
     */
    public function getOwner()
    {
        return $this->owner;
    }

}
