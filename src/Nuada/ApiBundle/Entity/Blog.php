<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Blog
 * Uses ORM
 *
 * @ORM\Table(name="nl_blogs")
 * @ORM\Entity(repositoryClass="BlogRepository")
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="blog_url", type="string")
     */
    protected $blogUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_path", type="string")
     */
    protected $imagePath;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    protected $visible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    protected $modifiedAt;


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
     * Set Id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * Set blogUrl
     *
     * @param string $blogUrl
     */
    public function setBlogUrl($blogUrl)
    {
        $this->blogUrl = $blogUrl;
    }

    /**
     * Get blogUrl
     *
     * @return string 
     */
    public function getBlogUrl()
    {
        return $this->blogUrl;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
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
            'type'         => $this->getType(),
            'description'  => $this->getDescription(),
            'blog_url'     => $this->getBlogUrl(),
            'image_path'   => $this->getImagePath(),
            'visible'      => $this->getVisible(),
            'created_at'   => $this->getCreatedAt(),
            'modified_at'  => $this->getModifiedAt()
        );

        return $data;
    }
}
