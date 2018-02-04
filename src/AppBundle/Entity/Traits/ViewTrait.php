<?php

namespace AppBundle\Entity\Traits;


trait ViewTrait
{

    /**
     * @ORM\Column(type="integer")
     */
    private $views = 0;

    /**
     * Gets the active status
     * @return bool
     */
    public function getViews()
    {
        return $this->views;
    }



    public function addView()
    {
        return ++$this->views;
    }
}

