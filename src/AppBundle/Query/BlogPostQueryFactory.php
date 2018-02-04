<?php

namespace AppBundle\Query;

use Doctrine\ORM\EntityManagerInterface;

/**
 * BlogPostQueryFactory
 */
class BlogPostQueryFactory
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * @return \AppBundle\Query\BlogPostQuery
     */
    public function create() {
        return new BlogPostQuery($this->entityManager);
    }
}
