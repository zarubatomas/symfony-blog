<?php

namespace AppBundle\Blog;

use Doctrine\ORM\EntityRepository;

class SlugGenerator implements ISlugGenerator
{

    /**
     * Generate slug
     * @return string
     */
    public function getSlugCandidate(EntityRepository $repository, $slug)
    {
        $item = $repository->findBy(['slug' => $slug]);

        if (!$item) {
            return $slug;
        }

        $i = 1;

        do {
            $candidate = $slug . '-' . $i;
            $i++;
        } while ($repository->findBy(['slug' => $candidate]));

        return $candidate;
    }
}
