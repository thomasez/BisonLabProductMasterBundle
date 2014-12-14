<?php

namespace BisonLab\ProductMasterBundle\Entity;
use BisonLab\ProductMasterBundle\Entity\Base as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * BisonLab\ProductMasterBundle\Entity\Catalog
 *
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\CatalogRepository")
 *
 */

class Catalog extends Base\Catalog
{

    public function __toString()
    {
        return (string)$this->name;
    }

}
