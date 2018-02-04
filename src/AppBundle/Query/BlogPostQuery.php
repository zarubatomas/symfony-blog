<?php

namespace AppBundle\Query;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * BlogPostQuery
 */
class BlogPostQuery
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var array
     */
    private $filter = [];



    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * @param bool|true $active
     * @return $this
     */
    public function byActive($active = true)
    {
        $this->filter[] = function (QueryBuilder $qb) use ($active) {
            $qb->andWhere('p.active = :active')
               ->setParameter('active', $active);
        };

        return $this;
    }



    /**
     * @param Tag $tag
     * @return $this
     */
    public function byTag(Tag $tag)
    {
        $this->filter[] = function (QueryBuilder $qb) use ($tag) {
            $qb->andWhere(':tag MEMBER OF p.tags')
               ->setParameter('tag', $tag);
        };

        return $this;
    }



    /**
     * @param $order
     * @return $this
     */
    public function orderByLatest($order)
    {
        $this->filter[] = function (QueryBuilder $qb) use ($order) {
            $qb->orderBy('p.created_at', $order);
        };

        return $this;
    }



    /**
     * @return QueryBuilder
     */
    public function doCreateQuery()
    {
        return $this->doCreateBasicDql();
    }



    /**
     * @return QueryBuilder
     */
    protected function doCreateCountQuery()
    {
        return $this->doCreateBasicDql()->select('COUNT(p.id)');
    }



    /**
     * @return QueryBuilder
     */
    private function doCreateBasicDql()
    {
        $qb = $this->entityManager->createQueryBuilder()
                ->select('p')
                ->from(BlogPost::class, 'p');

        foreach ($this->filter as $modify) {
            $modify($qb);
        }

        return $qb;
    }
}
