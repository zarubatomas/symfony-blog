<?php

namespace AppBundle\Entity\Traits;


trait ActiveTrait
{

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $active = false;

    /**
     * Gets the active status
     * @return bool
     */
    public function isActive()
    {
        return ($this->active ? true : false);
    }

    /**
     * Sets the active status
     * @param  string $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
}

