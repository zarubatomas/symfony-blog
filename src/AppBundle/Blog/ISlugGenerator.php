<?php

namespace AppBundle\Blog;

use Doctrine\ORM\EntityRepository;

interface ISlugGenerator
{

    /**
     * Generate slug
     * @return string
     */
    public function getSlugCandidate(EntityRepository $repository, $slug);
}
