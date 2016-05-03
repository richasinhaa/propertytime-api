<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\AgencyNeighbourhood
 * Uses ORM
 *
 * @ORM\Table(name="nl_agency_neighbourhood")
 * @ORM\Entity(repositoryClass="AgencyNeighbourhoodRepository")
 */
class AgencyNeighbourhood
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $agencyId
     *
     * @ORM\Column(name="agency_id", type="integer")
     */
    protected $agencyId;

    /**
     * @var integer $neighbourhoodId
     *
     * @ORM\Column(name="neighbourhood_id", type="integer")
     */
    protected $neighbourhoodId;

    /**
     * @var boolean $deleted
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
     * Set agencyId
     *
     * @param integer $agencyId
     */
    public function setAgencyId($agencyId)
    {
        $this->agencyId = $agencyId;
    }

    /**
     * Get agencyId
     *
     * @return integer 
     */
    public function getAgencyId()
    {
        return $this->agencyId;
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
            'id'                        => $this->getId(),
            'agency_id'                 => $this->getAgencyId(),
            'neighbourhood_id'          => $this->getNeighbourhoodId(),
            'deleted'                   => $this->getDeleted()
        );

        return $data;
    }
}
