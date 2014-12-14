<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Base\ProductCampaign
 *
 * @ORM\Table(name="product_campaign")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductCampaignRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="integer")
 * @ORM\DiscriminatorMap({"0" = "BisonLab\ProductMasterBundle\Entity\ProductCampaign"})
 */
abstract class ProductCampaign
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
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", inversedBy="product_campaigns")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    private $product;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Campaign", inversedBy="product_campaigns")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     */
    private $campaign;

    /**
     * @ORM\Column(name="user_selectable", type="boolean", nullable=true) 
     */
    protected $user_selectable;

    /**
     * @ORM\Column(name="total_price", type="integer", nullable=true) 
     */
    protected $total_price;

    /**
     * @ORM\Column(name="description", type="text", nullable=true) 
     */
    protected $description;

    /**
     * @ORM\Column(name="created_at", type="datetimetz", nullable=true) 
     */
    protected $created_at;

    /**
     * @ORM\Column(name="updated_at", type="datetimetz", nullable=true) 
     */
    protected $updated_at;

    /**
     * @ORM\Column(name="created_by", type="integer", nullable=true) 
     */
    protected $created_by;

    /**
     * @ORM\Column(name="updated_by", type="integer", nullable=true) 
     */
    protected $updated_by;

    public function __construct() {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
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
     * Set total_price
     *
     * @param integer $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->total_price = $totalPrice;
    }

    /**
     * Get total_price
     *
     * @return integer 
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set product
     *
     * @param object $product
     */
    public function setProduct($product)
    {
error_log("Setting a product:" . gettype($product));
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
     * Set campaign
     *
     * @param object $campaign
     */
    public function setCampaign($campaign)
    {
error_log("Setting a campaign:" . gettype($campaign));
        $this->campaign = $campaign;
    }

    /**
     * Get campaign
     *
     * @return object 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /*
     *
     * This is a copy of Product.php  get/set for these. Should I rather extend
     * some abstract/library? Not everyone agrees.
     *
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    public function setUpdatedBy($u)
    {
        if (is_numeric($u)) {
            $this->updated_by = $u;
        } elseif (get_class($u)) {
            $this->updated_by = $u->getId();
        }
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy($u)
    {
        if (is_numeric($u)) {
            $this->created_by = $u;
        } elseif (get_class($u)) {
            $this->created_by = $u->getId();
        }
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($v)
    {
        if (is_numeric($v)) {
            $this->updated_at = new \DateTime("@$v");
        } elseif (is_scalar($v)) {
            $this->updated_at = new \DateTime($v);
        } elseif ($v instanceof \DateTime) {
            $this->updated_at = $v;
        } else {
            throw new \UnexpectedValueException("Unknown timestamp");
        }
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($v)
    {
        if (is_numeric($v)) {
            $this->created_at = new \DateTime("@$v");
        } elseif (is_scalar($v)) {
            $this->created_at = new \DateTime($v);
        } elseif ($v instanceof \DateTime) {
            $this->created_at = $v;
        } else {
            throw new \UnexpectedValueException("Unknown timestamp");
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function updated()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
