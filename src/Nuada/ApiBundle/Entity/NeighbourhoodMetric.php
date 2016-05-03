<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\NeighbourhoodMetric
 * Uses ORM
 *
 * @ORM\Table(name="nl_neighbourhood_metrics")
 * @ORM\Entity(repositoryClass="NeighbourhoodMetricRepository")
 */
class NeighbourhoodMetric
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="neighbourhood_id", type="integer")
     */
    protected $neighbourhoodId;

    /**
     * @var float
     *
     * @ORM\Column(name="neighbourhood_name", type="string")
     */
    protected $neighbourhoodName;

    /**
     * @var float
     *
     * @ORM\Column(name="avg_sales_price", type="float")
     */
    protected $avgSalesPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="avg_rental_value", type="float")
     */
    protected $avgRentalValue;

    /**
     * @var float
     *
     * @ORM\Column(name="maintenance_fee", type="float")
     */
    protected $maintenanceFee;

    /**
     * @var float
     *
     * @ORM\Column(name="annual_gross_yield", type="float")
     */
    protected $annualGrossYield;

    /**
     * @var float
     *
     * @ORM\Column(name="occupancy", type="float")
     */
    protected $occupancy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;


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
     * Set neighbourhoodId
     *
     * @param integer $neighbourhoodId
     */
    public function setNeighbourhoodId($neighbourhoodId)
    {
        $this->neighbourhoodId = $neighbourhoodId;
    }

    /**
     * Get neighbourhoodId
     *
     * @return integer 
     */
    public function getNeighbourhoodId()
    {
        return $this->neighbourhoodId;
    }


    /**
     * Set neighbourhoodName
     *
     * @param string $neighbourhoodName
     */
    public function setNeighbourhoodName($neighbourhoodName)
    {
        $this->neighbourhoodName = $neighbourhoodName;
    }

    /**
     * Get neighbourhoodName
     *
     * @return string 
     */
    public function getNeighbourhoodName()
    {
        return $this->neighbourhoodName;
    }

    /**
     * Set avgSalesPrice
     *
     * @param float $avgSalesPrice
     */
    public function setAvgSalesPrice($avgSalesPrice)
    {
        $this->avgSalesPrice = $avgSalesPrice;
    }

    /**
     * Get avgSalesPrice
     *
     * @return float 
     */
    public function getAvgSalesPrice()
    {
        return $this->avgSalesPrice;
    }

    /**
     * Set avgRentalValue
     *
     * @param float $avgRentalValue
     */
    public function setAvgRentalValue($avgRentalValue)
    {
        $this->avgRentalValue = $avgRentalValue;
    }

    /**
     * Get avgRentalValue
     *
     * @return float 
     */
    public function getAvgRentalValue()
    {
        return $this->avgRentalValue;
    }

    /**
     * Set maintenanceFee
     *
     * @param float $maintenanceFee
     */
    public function setMaintenanceFee($maintenanceFee)
    {
        $this->maintenanceFee = $maintenanceFee;
    }

    /**
     * Get maintenanceFee
     *
     * @return float 
     */
    public function getMaintenanceFee()
    {
        return $this->maintenanceFee;
    }

    /**
     * Set annualGrossYield
     *
     * @param float $annualGrossYield
     */
    public function setAnnualGrossYield($annualGrossYield)
    {
        $this->annualGrossYield = $annualGrossYield;
    }

    /**
     * Get annualGrossYield
     *
     * @return float 
     */
    public function getAnnualGrossYield()
    {
        return $this->annualGrossYield;
    }

    /**
     * Set occupancy
     *
     * @param float $occupancy
     */
    public function setOccupancy($occupancy)
    {
        $this->occupancy = $occupancy;
    }

    /**
     * Get occupancy
     *
     * @return float 
     */
    public function getOccupancy()
    {
        return $this->occupancy;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'                     => $this->getId(),
            'neighbourhood_id'       => $this->getNeighbourhoodId(),
            'neighbourhood_name'     => $this->getNeighbourhoodName(),
            'avg_sales_price'        => $this->getAvgSalesPrice(),
            'avg_rental_value'       => $this->getAvgRentalValue(),
            'maintenance_fee'        => $this->getMaintenanceFee(),
            'annual_gross_yield'     => $this->getAnnualGrossYield(),
            'occupancy'              => $this->getOccupancy(),
            'deleted'                => $this->getDeleted()
        );

        return $data;
    }
}
