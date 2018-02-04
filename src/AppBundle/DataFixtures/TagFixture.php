<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Tag;
use AppBundle\Facade\TagFacade;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocur\Slugify\Slugify;

class TagFixture extends Fixture implements OrderedFixtureInterface
{

    /**
     * @var TagFacade
     */
    private $tagFacade;

    /**
     * @var SlugifyInterface
     */
    private $slugify;


    /**
     * @param TagFacade $tagFacade
     */
    public function __construct(TagFacade $tagFacade, SlugifyInterface $slugify)
    {
        $this->tagFacade = $tagFacade;
        $this->slugify = $slugify;
    }



    /**
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $tag = new Tag();
        $name = 'tag1';

        $tag->setName($name);
        $tag->setSlug($this->tagFacade->getSlugCandidate($this->slugify->slugify($name)));

        $this->addReference('tag-tag1', $tag);

        $objectManager->persist($tag);

        $tag = new Tag();
        $name = 'tag2';
        $tag->setName($name);
        $tag->setSlug($this->tagFacade->getSlugCandidate($this->slugify->slugify($name)));

        $this->addReference('tag-tag2', $tag);

        $objectManager->persist($tag);


        $objectManager->flush();
    }



    public function getOrder()
    {
        return 1;
    }
}