<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;
use BisonLab\ProductMasterBundle\Entity as Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * BisonLab\ProductMasterBundle\Entity\Base\Catalog
 *
 * @ORM\Table(name="catalog")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\CatalogRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="integer")
 * @ORM\DiscriminatorMap({"0" = "BisonLab\ProductMasterBundle\Entity\Catalog"})
 */
abstract class Catalog
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
     * @ORM\Column(name="identifier", type="string", length=40, unique=true)
     */
    protected $identifier;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string $originating_from
     *
     * @ORM\Column(name="originating_from", type="string", length=255, nullable=true)
     */
    protected $originating_from;

    /**
     * @var string $external_id
     *
     * @ORM\Column(name="external_id", type="string", length=255, nullable=true)
     */
    protected $external_id;

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
     * @ORM\OneToMany(targetEntity="BisonLab\ProductMasterBundle\Entity\ProductCatalog", mappedBy="catalog")
     *
     * @var array
     */
    protected $product_catalogs;

    public function __construct() {
        $this->product_catalogs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set originating_from
     *
     * @param string $originatingFrom
     */
    public function setOriginatingFrom($originatingFrom)
    {
        $this->originating_from = $originatingFrom;
    }

    /**
     * Get originating_from
     *
     * @return string 
     */
    public function getOriginatingFrom()
    {
        return $this->originating_from;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;
    }

    /**
     * Get external_id
     *
     * @return string 
     */
    public function getExternalId()
    {
        return $this->external_id;
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

}
