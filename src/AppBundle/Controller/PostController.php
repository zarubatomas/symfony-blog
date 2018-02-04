<?php

namespace AppBundle\Controller;

use AppBundle\Repository\BlogPostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Facade\BlogPostFacade;

class PostController extends Controller
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
     * @var PaginatorInterface
     */
    private $paginator;



    public function __construct(
        BlogPostFacade $blogPostFacade,
        BlogPostRepository $blogPostRepository,
        PaginatorInterface $paginator)
    {
        $this->blogPostFacade = $blogPostFacade;
        $this->blogPostRepository = $blogPostRepository;
        $this->paginator = $paginator;
    }



    public function listAction($page = 1)
    {

        $query = $this->blogPostFacade->getActivePostsQuery();

        $pagination = $this->paginator->paginate($query, $page, $this->container->getParameter('posts_per_page'));
        $pagination->setUsedRoute('post_list');

        return $this->render('post/list.html.twig', [
            'pagination' => $pagination
        ]);
    }



    public function detailAction($slug)
    {
        $post = $this->blogPostRepository->findOneBy(['slug' => $slug, 'active' => true]);

        if (!$post) {
            throw $this->createNotFoundException(
                'No post was found for this slug: ' . $slug
            );
        }

        //add view
        $this->blogPostRepository->addViewToPost($post);

        return $this->render('post/detail.html.twig', [
            'post' => $post
        ]);
    }

}
