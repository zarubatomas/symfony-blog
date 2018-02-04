<?php

namespace AppBundle\Facade;

use AppBundle\Blog\SlugGenerator;
use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Tag;
use AppBundle\Query\BlogPostQueryFactory;
use AppBundle\Repository\BlogPostRepository;

/**
 * BlogPostFacade
 *
 */
class BlogPostFacade
{

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;


    /**
     * @var BlogPostQueryFactory
     */
    private $blogPostQueryFactory;

    /**
     * @var SlugGenerator
     */
    private $slugGenerator;



    /**
     * @param BlogPostRepository $blogPostRepository
     * @param BlogPostQueryFactory $blogPostQueryFactory
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(
        BlogPostRepository $blogPostRepository,
        BlogPostQueryFactory $blogPostQueryFactory,
        SlugGenerator $slugGenerator)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->blogPostQueryFactory = $blogPostQueryFactory;
        $this->slugGenerator = $slugGenerator;
    }



    /**
     * @param $slug
     * @return string
     */
    public function getSlugCandidate($slug)
    {

        return $this->slugGenerator->getSlugCandidate($this->blogPostRepository, $slug);
    }



    /**
     * @return \Doctrine\ORM\Query
     */
    public function getActivePostsQuery()
    {
        $blogPostQuery = $this->blogPostQueryFactory->create()
            ->byActive()
            ->orderByLatest('DESC');

        return $blogPostQuery
            ->doCreateQuery()
            ->getQuery();
    }



    /**
     * @param Tag $tag
     * @return \Doctrine\ORM\Query
     */
    public function getActivePostsInTagQuery(Tag $tag)
    {
        $blogPostQuery = $this->blogPostQueryFactory->create()
            ->byActive()
            ->byTag($tag)
            ->orderByLatest('DESC');

        return $blogPostQuery
            ->doCreateQuery()
            ->getQuery();
    }



    public function convertPostToArray(BlogPost $post)
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'created_at' => $post->getCreatedAt()->format('c'),
            'author' => $post->getAuthor()->getId(),
            'views' => $post->getViews(),
            'active' => $post->isActive()
        ];
    }
}
