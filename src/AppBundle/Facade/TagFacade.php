<?php

namespace AppBundle\Facade;

use AppBundle\Blog\SlugGenerator;
use AppBundle\Repository\TagRepository;


class TagFacade
{

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var SlugGenerator
     */
    private $slugGenerator;



    /**
     * @param TagRepository $tagRepository
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(TagRepository $tagRepository, SlugGenerator $slugGenerator)
    {
        $this->tagRepository = $tagRepository;
        $this->slugGenerator = $slugGenerator;
    }



    /**
     * Create unique slug from slug candidate
     * @param $slug
     * @return string
     */
    public function getSlugCandidate($slug)
    {

        return $this->slugGenerator->getSlugCandidate($this->tagRepository, $slug);
    }


}
