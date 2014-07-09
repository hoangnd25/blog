<?php

namespace App\BlogBundle\DataFixtures\ORM;

use App\BlogBundle\Entity\Post;
use App\BlogBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach(range(1,10) as $i){
            $post = new Post();
            $post->setPublished(true);
            $post->setTitle('Suspendisse architecto ultricies risus? '.$i);
            $post->setIntro('Pariatur minus possimus aperiam, ducimus porttitor pretium inventore fusce, tristique saepe,
            voluptates eligendi sociosqu, erat ipsum error harum at earum placerat? Laboris tempore lobortis nonummy.');

            $post->setBody('Pariatur minus possimus aperiam, ducimus porttitor pretium inventore fusce, tristique saepe,
            voluptates eligendi sociosqu, erat ipsum error harum at earum placerat? Laboris tempore lobortis nonummy
            diamlorem conubia cumque proin tempore cupidatat perspiciatis viverra per exercitation corporis per libero,
             laoreet voluptate, mollis iste! Congue nonummy dolorum pulvinar ducimus orci fames dictumst.

            Dolorem suspendisse pariatur esse, mattis posuere sollicitudin aliquet omnis! Morbi magnis orci scelerisque quo varius,
            maiores ullam minim scelerisque ante lacus, culpa pellentesque malesuada praesent habitasse ante,
            quibusdam quae autem, quasi posuere iaculis facilis, suscipit, provident? Alias eveniet repellendus ultrices,
            aliquip ullam, risus tempore nec, rem dignissimos nisl habitasse? Porro.');

            if($i==1){
                $tag = new Tag('test');
                $tag->getPosts()->add($post);
                $post->getTags()->add($tag);

            }

            $seoPresentation = $this->container->get('cmf_seo.presentation');
            $seoPresentation-> updateSeoPage($post);

            $manager->persist($post);
        }

        $manager->flush();


//        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}