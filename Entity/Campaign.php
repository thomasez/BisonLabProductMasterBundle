<?php

namespace BisonLab\ProductMasterBundle\Entity;
use BisonLab\ProductMasterBundle\Entity\Base as Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Campaign
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\CampaignRepository")
 */
class Campaign extends Base\Campaign
{
    public function __toString()
    {
        return (string)$this->getName();
    }
}
