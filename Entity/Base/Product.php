<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Base\Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="integer")
 * @ORM\DiscriminatorMap({"0" = "BisonLab\ProductMasterBundle\Entity\Product"})
 */
abstract class Product
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $identifier
     *
     * @ORM\Column(name="identifier", type="string", length=255, nullable=true, unique=true)
     */
    protected $identifier;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string $long_description
     *
     * @ORM\Column(name="long_description", type="text", nullable=true)
     */
    protected $long_description;

    /**
     * Shame I have to use 'product_type' and not 'type' but that's a pretty 
     * used name around here and even my editor triggers on it.
     *
     * @var enum $product_type
     *
     * @ORM\Column(name="product_type", type="string", length=20)
     *
     */
    protected $product_type;

    /**
     * @var string $product_group
     *
     * @ORM\Column(name="product_group", type="string", length=30, nullable=true)
     */
    protected $product_group;

    /**
     * @ORM\OneToMany(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var integer $one_time_price
     *
     * @ORM\Column(name="one_time_price", type="integer", nullable=true)
     */
    protected $one_time_price;

    /**
     * @var datetimetz $subscription_price
     *
     * @ORM\Column(name="subscription_price", type="integer", nullable=true)
     */
    protected $subscription_price;

    /**
     * @var datetimetz $sale_start
     *
     * @ORM\Column(name="sale_start", type="datetimetz", nullable=true)
     */
    protected $sale_start;

    /**
     * @var datetimetz $sale_end
     *
     * @ORM\Column(name="sale_end", type="datetimetz", nullable=true)
     */
    protected $sale_end;

    /**
     * @var datetimetz $start_date
     *
     * @ORM\Column(name="start_date", type="datetimetz", nullable=true)
     */
    protected $start_date;

    /**
     * @var datetimetz $end_date
     *
     * @ORM\Column(name="end_date", type="datetimetz", nullable=true)
     */
    protected $end_date;

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

    /**
     * @ORM\OneToMany(targetEntity="BisonLab\ProductMasterBundle\Entity\ProductCatalog", mappedBy="product") 
     */
    protected $product_catalogs;

    /**
     * @ORM\OneToMany(targetEntity="BisonLab\ProductMasterBundle\Entity\ProductCampaign", mappedBy="product") 
     */
    protected $product_campaigns;

    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product_catalogs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product_campaigns = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set identifier
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set long_description
     *
     * @param string $long_description
     */
    public function setLongDescription($long_description)
    {
        $this->long_description = $long_description;
    }

    /**
     * Get long_description
     *
     * @return string 
     */
    public function getLongDescription()
    {
        return $this->long_description;
    }

    /**
     * Get product_type
     *
     * @return string 
     */
    public function getProductType()
    {
        return $this->product_type;
    }

    /**
     * Set product_type
     *
     * @param string $product_type
     */
    public function setProductType($product_type)
    {
        if (!array_key_exists($product_type, $this->getAvailableProductTypes())) {
            throw new \InvalidArgumentException("Invalid product type ("
                        . $product_type .")");
        }
        $this->product_type = $product_type;
    }

    /**
     * Get product_group
     *
     * @return string 
     */
    public function getProductGroup()
    {
        return $this->product_group;
    }

    /**
     * Set product_group
     *
     * @param string $product_group
     */
    public function setProductGroup($product_group)
    {
        $this->product_group = $product_group;
    }

    /**
     * Set one_time_price
     *
     * @param string $one_time_price
     */
    public function setOneTimePrice($one_time_price)
    {
        $this->one_time_price = $one_time_price;
    }

    /**
     * Get one_time_price
     *
     * @return string 
     */
    public function getOneTimePrice()
    {
        return $this->one_time_price;
    }

    /**
     * Set name
     *
     * @param string $subscription_price
     */
    public function setSubscriptionPrice($subscription_price)
    {
        $this->subscription_price = $subscription_price;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getSubscriptionPrice()
    {
        return $this->subscription_price;
    }

    /**
     * Set sale_start
     *
     * @param datetimetz $saleStart
     */
    public function setSaleStart($saleStart)
    {
        $this->sale_start = $saleStart;
    }

    /**
     * Get sale_start
     *
     * @return datetimetz 
     */
    public function getSaleStart()
    {
        return $this->sale_start;
    }

    /**
     * Set sale_end
     *
     * @param datetimetz $saleEnd
     */
    public function setSaleEnd($saleEnd)
    {
        $this->sale_end = $saleEnd;
    }

    /**
     * Get sale_end
     *
     * @return datetimetz 
     */
    public function getSaleEnd()
    {
        return $this->sale_end;
    }

    /**
     * Set start_date
     *
     * @param datetimetz $startDate
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    }

    /**
     * Get start_date
     *
     * @return datetimetz 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param datetimetz $endDate
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
    }

    /**
     * Get end_date
     *
     * @return datetimetz 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

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

    /**
     * Get product_catalogs
     *
     * @return ArrayCollection 
     */
    public function getProductCatalogs()
    {
        return $this->product_catalogs;
    }

    
}
