<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Base\ProductCatalog
 *
 * @ORM\Table(name="product_catalog")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductCatalogRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="integer")
 * @ORM\DiscriminatorMap({"0" = "BisonLab\ProductMasterBundle\Entity\ProductCatalog"})
 */
abstract class ProductCatalog
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
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Product", inversedBy="product_catalogs")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     */
    private $product;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="BisonLab\ProductMasterBundle\Entity\Catalog", inversedBy="product_catalogs")
     * @ORM\JoinColumn(name="catalog_id", referencedColumnName="id")
     */
    private $catalog;

    /**
     * @var integer $external_product_id
     *
     * @ORM\Column(name="external_product_id", type="string", length=255, nullable=true)
     */
    private $external_product_id;

    /**
     * @var string $external_product_name
     *
     * @ORM\Column(name="external_product_name", type="string", length=255, nullable=true)
     */
    private $external_product_name;

    /**
     * @var text $external_product_description
     *
     * @ORM\Column(name="external_product_description", type="text", nullable=true)
     */
    private $external_product_description;

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
     * Set external_product_id
     *
     * @param integer $externalProductId
     */
    public function setExternalProductId($externalProductId)
    {
        $this->external_product_id = $externalProductId;
    }

    /**
     * Get external_product_id
     *
     * @return integer 
     */
    public function getExternalProductId()
    {
        return $this->external_product_id;
    }

    /**
     * Set external_product_name
     *
     * @param string $externalProductName
     */
    public function setExternalProductName($externalProductName)
    {
        $this->external_product_name = $externalProductName;
    }

    /**
     * Get external_product_name
     *
     * @return string 
     */
    public function getExternalProductName()
    {
        return $this->external_product_name;
    }

    /**
     * Set external_product_description
     *
     * @param text $externalProductDescription
     */
    public function setExternalProductDescription($externalProductDescription)
    {
        $this->external_product_description = $externalProductDescription;
    }

    /**
     * Get external_product_description
     *
     * @return text 
     */
    public function getExternalProductDescription()
    {
        return $this->external_product_description;
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
     * Set catalog
     *
     * @param object $catalog
     */
    public function setCatalog($catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * Get catalog
     *
     * @return object 
     */
    public function getCatalog()
    {
        return $this->catalog;
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
