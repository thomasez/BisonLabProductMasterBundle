<?php

namespace BisonLab\ProductMasterBundle\Entity;
use BisonLab\ProductMasterBundle\Entity\Base as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * BisonLab\ProductMasterBundle\Entity\ProductCampaign
 *
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductCampaignRepository")
 *
 */
class ProductCampaign extends Base\ProductCampaign
{

    protected $available_campaigns = array();

    public function getProductName()
    {
        return (string)$this->getProduct()->getName();
    }

    public function getProductId()
    {
        return (int)$this->getProduct()->getId();
    }

    public function getCampaignName()
    {
        return (string)$this->getCampaign()->getName();
    }

    public function getCampaignId()
    {
        return (int)$this->getCampaign()->getId();
    }

    public function setAvailableCampaigns($campaigns) {

        $this->available_campaigns = $campaigns;

    }

    public function getAvailableCampaigns() {

        return is_array($this->available_campaigns) ? $campaigns : array();

    }

    public function getAvailableCampaignsAsStringList() {

        if (is_array($this->available_campaigns)) {
            $list = array();
            foreach ($this->available_campaigns as $campaign) {
                $list[$campaign->getId()] = $campaign->getName();
            }
            return $list;
        } else {
            return array();
        }

    }

}
