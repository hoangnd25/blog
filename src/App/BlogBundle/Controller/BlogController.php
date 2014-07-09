<?php

namespace App\BlogBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    /**
     * @Route("/blog/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('p')
            ->from('AppBlogBundle:Post', 'p')
            ->where('p.published = :published')
            ->setParameter('published',true)
            ->andWhere('p.slug = :slug')
            ->setParameter('slug',$slug)
        ;
        $query = $qb->getQuery();
        $post = $query->getResult(Query::HYDRATE_ARRAY);
        $post = reset($post);
        return array('post'=> $post);
    }

    /**
     * @Route("_internal/blog/latest")
     * @Template()
     */
    public function latestBlogAction()
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('p.title,p.intro,p.created,p.slug')
            ->from('AppBlogBundle:Post', 'p')
            ->where('p.published = :published')
            ->setParameter('published',true)
            ->orderBy('p.created','desc')
        ;
        $query = $qb->getQuery();
        $query->setMaxResults(6);
        $posts = $query->getResult(Query::HYDRATE_ARRAY);

        return array('posts'=> $posts);
    }
}
