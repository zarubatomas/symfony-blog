<?php

namespace AppBundle\Controller;

use AppBundle\Repository\TagRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Facade\BlogPostFacade;

class TagController extends Controller
{
    /**
     * @var BlogPostFacade
     */
    private $blogPostFacade;

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;



    public function __construct(
        BlogPostFacade $blogPostFacade,
        TagRepository $tagRepository,
        PaginatorInterface $paginator)
    {
        $this->blogPostFacade = $blogPostFacade;
        $this->tagRepository = $tagRepository;
        $this->paginator = $paginator;
    }



    public function detailAction($slug, $page)
    {
        $tag = $this->tagRepository->findOneBy(['slug' => $slug]);

        if (!$tag) {
            throw $this->createNotFoundException(
                'No tag was found for this slug: ' . $slug
            );
        }

        $query = $this->blogPostFacade->getActivePostsInTagQuery($tag);

        $pagination = $this->paginator->paginate($query, $page, $this->container->getParameter('posts_per_page'));
        $pagination->setUsedRoute('tag_detail');

        return $this->render('tag/detail.html.twig', [
            'tag' => $tag,
            'pagination' => $pagination
        ]);
    }

}
