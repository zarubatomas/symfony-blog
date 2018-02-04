<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\BlogPost;
use AppBundle\Facade\BlogPostFacade;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var BlogPostFacade
     */
    private $blogPostFacade;

    /**
     * @var SlugifyInterface
     */
    private $slugify;



    /**
     * @param BlogPostFacade $blogPostFacade
     */
    public function __construct(BlogPostFacade $blogPostFacade, SlugifyInterface $slugify)
    {
        $this->blogPostFacade = $blogPostFacade;
        $this->slugify = $slugify;
    }



    /**
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $post = new BlogPost();
        $title = 'Blog Article 1';

        $post
            ->setTitle($title)
            ->setSlug($this->blogPostFacade->getSlugCandidate($this->slugify->slugify($title)))
            ->setText('text for article 1')
            ->setActive(true)
            ->setAuthor($this->getReference('admin-user'))
            ->addTag($this->getReference('tag-tag1'));

        $objectManager->persist($post);

        $post2 = new BlogPost();
        $title = 'Blog Article 2';
        $post2
            ->setTitle($title)
            ->setSlug($this->blogPostFacade->getSlugCandidate($this->slugify->slugify($title)))
            ->setText('text for article 2')
            ->setActive(true)
            ->setAuthor($this->getReference('admin-user'))
            ->addTag($this->getReference('tag-tag2'));

        $objectManager->persist($post2);

        $post3 = new BlogPost();
        $title = 'Blog Article 3';
        $post3
            ->setTitle($title)
            ->setSlug($this->blogPostFacade->getSlugCandidate($this->slugify->slugify($title)))
            ->setText('text for article 3')
            ->setActive(true)
            ->setAuthor($this->getReference('admin-user'))
            ->addTag($this->getReference('tag-tag2'))
            ->addTag($this->getReference('tag-tag1'));


        $objectManager->persist($post3);
        $objectManager->flush();
    }



    public function getOrder()
    {
        return 3;
    }
}