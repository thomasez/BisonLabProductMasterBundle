<?php

namespace BisonLab\ProductMasterBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Base\Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\CampaignRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="integer")
 * @ORM\DiscriminatorMap({"0" = "BisonLab\ProductMasterBundle\Entity\Campaign"})
 */
class Campaign
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", length=255, nullable=true)
     */
    private $description;

    /**
     * @var datetimetz $start_date
     *
     * @ORM\Column(name="start_date", type="datetimetz", nullable=true)
     */
    private $start_date;

    /**
     * @var datetimetz $end_date
     *
     * @ORM\Column(name="end_date", type="datetimetz", nullable=true)
     */
    private $end_date;

    /**
     * @var integer $price
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var integer $min_price
     *
     * @ORM\Column(name="min_price", type="integer", nullable=true)
     */
    private $min_price;

    /**
     * @var integer $rebate_percent
     *
     * @ORM\Column(name="rebate_percent", type="integer", nullable=true)
     */
    private $rebate_percent;

    /**
     * @var integer $rebate_amount
     *
     * @ORM\Column(name="rebate_amount", type="integer", nullable=true)
     */
    private $rebate_amount;

    /**
     * @var string $campaign_period
     *
     * @ORM\Column(name="campaign_period", type="string", length=30, nullable=true)
     */
    private $campaign_period;

    /**
     * @var integer $campaign_period_amount
     *
     * @ORM\Column(name="campaign_period_amount", type="integer", nullable=true)
     */
    private $campaign_period_amount;

    /**
     * @var string $binding_period
     *
     * @ORM\Column(name="binding_period", type="string", length=30, nullable=true)
     */
    private $binding_period;

    /**
     * @var string $binding_period_amount
     *
     * @ORM\Column(name="binding_period_amount", type="integer", nullable=true)
     */
    private $binding_period_amount;

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
     * @ORM\OneToMany(targetEntity="BisonLab\ProductMasterBundle\Entity\ProductCampaign", mappedBy="campaign")
     *
     * @var array
     */
    protected $product_campaigns;

    public function __construct() {
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

    /**
     * Set price
     *
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set min_price
     *
     * @param integer $minPrice
     */
    public function setMinPrice($minPrice)
    {
        $this->min_price = $minPrice;
    }

    /**
     * Get min_price
     *
     * @return integer 
     */
    public function getMinPrice()
    {
        return $this->min_price;
    }

    /**
     * Set rebate_percent
     *
     * @param integer $rebatePercent
     */
    public function setRebatePercent($rebatePercent)
    {
        $this->rebate_percent = $rebatePercent;
    }

    /**
     * Get rebate_percent
     *
     * @return integer 
     */
    public function getRebatePercent()
    {
        return $this->rebate_percent;
    }

    /**
     * Set rebate_amount
     *
     * @param integer $rebateAmount
     */
    public function setRebateAmount($rebateAmount)
    {
        $this->rebate_amount = $rebateAmount;
    }

    /**
     * Get rebate_amount
     *
     * @return integer 
     */
    public function getRebateAmount()
    {
        return $this->rebate_amount;
    }

    /**
     * Set campaign_period
     *
     * @param string $campaignPeriod
     */
    public function setCampaignPeriod($campaignPeriod)
    {
        $this->campaign_period = $campaignPeriod;
    }

    /**
     * Get campaign_period
     *
     * @return string 
     */
    public function getCampaignPeriod()
    {
        return $this->campaign_period;
    }

    /**
     * Set campaign_period_amount
     *
     * @param integer $campaignPeriodAmount
     */
    public function setCampaignPeriodAmount($campaignPeriodAmount)
    {
        $this->campaign_period_amount = $campaignPeriodAmount;
    }

    /**
     * Get campaign_period_amount
     *
     * @return integer 
     */
    public function getCampaignPeriodAmount()
    {
        return $this->campaign_period_amount;
    }

    /**
     * Set binding_period
     *
     * @param string $bindingPeriod
     */
    public function setBindingPeriod($bindingPeriod)
    {
        $this->binding_period = $bindingPeriod;
    }

    /**
     * Get binding_period
     *
     * @return string 
     */
    public function getBindingPeriod()
    {
        return $this->binding_period;
    }

    /**
     * Set binding_period_amount
     *
     * @param string $bindingPeriodAmount
     */
    public function setBindingPeriodAmount($bindingPeriodAmount)
    {
        $this->binding_period_amount = $bindingPeriodAmount;
    }

    /**
     * Get binding_period_amount
     *
     * @return string 
     */
    public function getBindingPeriodAmount()
    {
        return $this->binding_period_amount;
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
