<?php

namespace AppBundle\Entity\Traits;


trait SlugTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=512)
     */
    private $slug;



    /**
     * Set slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}

