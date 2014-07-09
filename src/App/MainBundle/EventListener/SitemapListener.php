<?php
namespace App\MainBundle\EventListener;

use Symfony\Component\Routing\RouterInterface;

use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query;

class SitemapListener implements SitemapListenerInterface
{
    private $router;
    private $doctrine;

    public function __construct(RouterInterface $router, Registry $doctrine)
    {
        $this->router = $router;
        $this->doctrine = $doctrine;

    }

    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();
        if (is_null($section) || $section == 'default') {
            //get absolute homepage url
            $url = $this->router->generate('index', array(), true);

            //add homepage url to the urlset named default
            $event->getGenerator()->addUrl(
                new UrlConcrete(
                    $url,
                    new \DateTime(),
                    UrlConcrete::CHANGEFREQ_HOURLY,
                    1
                ),
                'default'
            );

            $em = $this->doctrine->getManager();

            $qb = $em->createQueryBuilder();
            $qb
                ->select('p.slug')
                ->from('AppBlogBundle:Post', 'p')
                ->where('p.published = :published')
                ->setParameter('published',true)
                ->orderBy('p.created','desc')
            ;
            $query = $qb->getQuery();
            $posts = $query->getResult(Query::HYDRATE_ARRAY);
            foreach ($posts as $post) {
                $url = $this->router->generate('app_blog_blog_show', array('slug'=>$post['slug']), true);

                //add homepage url to the urlset named default
                $event->getGenerator()->addUrl(
                    new UrlConcrete(
                        $url,
                        new \DateTime(),
                        UrlConcrete::CHANGEFREQ_HOURLY,
                        1
                    ),
                    'default'
                );
            }


        }
    }
}