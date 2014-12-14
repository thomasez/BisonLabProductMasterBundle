<?php

namespace BisonLab\ProductMasterBundle\Entity;
use BisonLab\ProductMasterBundle\Entity\Base as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * BisonLab\ProductMasterBundle\Entity\ProductCatalog
 *
 * @ORM\Entity(repositoryClass="BisonLab\ProductMasterBundle\Entity\Repositories\ProductCatalogRepository")
 *
 */
class ProductCatalog extends Base\ProductCatalog
{

    protected $available_catalogs = array();

    public function getProductName()
    {
        return (string)$this->getProduct()->getName();
    }

    public function getProductId()
    {
        return (int)$this->getProduct()->getId();
    }

    public function getCatalogName()
    {
        return (string)$this->getCatalog()->getName();
    }

    public function getCatalogId()
    {
        return (int)$this->getCatalog()->getId();
    }

    public function setAvailableCatalogs($catalogs) {

        $this->available_catalogs = $catalogs;

    }

    public function getAvailableCatalogs() {

        return is_array($this->available_catalogs) ? $catalogs : array();

    }

    public function getAvailableCatalogsAsStringList() {

        if (is_array($this->available_catalogs)) {
            $list = array();
            foreach ($this->available_catalogs as $catalog) {
                $list[$catalog->getId()] = $catalog->getName();
            }
            return $list;
        } else {
            return array();
        }

    }

}
