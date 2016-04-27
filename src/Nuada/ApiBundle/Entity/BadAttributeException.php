<?php

namespace Nuada\ApiBundle\Entity;

/**
 * Nuada\ApiBundle\Entity\BadAttributeException
 */
class BadAttributeException extends \Exception
{
    /**
     * @var string $attributeName - Attribute Name
     */
    protected $attributeName;

    /**
     * @var string $error - Error
     */
    protected $error;

    /**
     * Constructor
     *
     * @param string $attributeName - Attribute Name
     * @param string $error         - Error
     */
    public function __construct($attributeName, $error = null)
    {
        $this->attributeName = $attributeName;
        $this->error = $error;
        if (!empty($error)) {
            $this->message = "Bad attribute '$attributeName'. $error";
        } else {
            $this->message = "Bad attribute '$attributeName'";
        }
    }

    /**
     * Get attributeName
     *
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}