<?php

namespace AppBundle\Controller;

use AppBundle\Facade\BlogPostFacade;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as EasyCorpAdminController;

class AdminController extends EasyCorpAdminController
{
    /**
     * @var BlogPostFacade
     */
    private $blogPostFacade;



    /**
     * @param BlogPostFacade $blogPostFacade
     */
    public function __construct(BlogPostFacade $blogPostFacade)
    {
        $this->blogPostFacade = $blogPostFacade;
    }



    /**
     * @param $entity
     */
    public function persistEntity($entity)
    {
        $this->updateSlug($entity);
        parent::persistEntity($entity);
    }



    /**
     * @param $entity
     */
    public function updateEntity($entity)
    {
        $this->updateSlug($entity);
        parent::updateEntity($entity);
    }



    /**
     * @param $entity
     */
    private function updateSlug($entity)
    {

        if (method_exists($entity, 'setSlug') and method_exists($entity, 'getTitle')) {
            $entity->setSlug($this->blogPostFacade->getSlugCandidate($this->get('slugify')->slugify($entity->getTitle())));
        }

        if (method_exists($entity, 'setSlug') and method_exists($entity, 'getName')) {
            $entity->setSlug($this->blogPostFacade->getSlugCandidate($this->get('slugify')->slugify($entity->getName())));
        }
    }

}
