<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\ProductAccount
 *
 * @ORM\Table(name="product_accoung")
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductAccountRepository")
 */
abstract class ProductAccount
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
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", inversedBy="product_accounts")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    private $product;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Account", inversedBy="product_accounts")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;

    /**
     * @ORM\Column(name="user_selectable", type="boolean", nullable=true) 
     */
    protected $user_selectable;

    /**
     /* Should be an enum, COST or REVENUE
     * @ORM\Column(name="type", type="text", nullable=true) 
     */
    protected $type;

    /**
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
     * Set account
     *
     * @param object $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * Get account
     *
     * @return object 
     */
    public function getAccount()
    {
        return $this->account;
    }

}
