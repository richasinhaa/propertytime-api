<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Neighbourhood
 * Uses ORM
 *
 * @ORM\Table(name="nl_neighbourhood")
 * @ORM\Entity(repositoryClass="NeighbourhoodRepository")
 */
class Neighbourhood
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @var integer $score
     *
     * @ORM\Column(name="score", type="float")
     */
    protected $score;


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
     * Set score
     *
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * Get score
     *
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'           => $this->getId(),
            'name'         => $this->getName(),
            'description'  => $this->getDescription(),
            'deleted'      => $this->getDeleted(),
            'score'        => $this->getScore()
        );

        return $data;
    }
}
