<?php

namespace AppBundle\Controller\Api;

use AppBundle\Repository\BlogPostRepository;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Facade\BlogPostFacade;

class PostsController extends FOSRestController
{

    /**
     * @var BlogPostFacade
     */
    private $blogPostFacade;

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;



    /**
     * @param BlogPostFacade $blogPostFacade
     * @param BlogPostRepository $blogPostRepository
     */
    public function __construct(
        BlogPostFacade $blogPostFacade,
        BlogPostRepository $blogPostRepository)
    {
        $this->blogPostFacade = $blogPostFacade;
        $this->blogPostRepository = $blogPostRepository;
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostsAction()
    {
        $query = $this->blogPostFacade->getActivePostsQuery();
        $posts = $query->getResult();

        if(!$posts) {
            $view = $this->view(null, 404);
        } else {

            $postsData = [];

            foreach ($posts as $post) {
                $postsData[] = $this->blogPostFacade->convertPostToArray($post);
            }

            $view = $this->view($postsData, 200);
        }

        return $this->handleView($view);
    }



    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostAction($id)
    {
        $post = $this->blogPostRepository->findOneBy(['id' => $id]);

        if (!$post) {
            $view = $this->view(null, 404);
        } else {

            //add view
            $this->blogPostRepository->addViewToPost($post);

            $view = $this->view($this->blogPostFacade->convertPostToArray($post), 200);
        }

        return $this->handleView($view);
    }

}
