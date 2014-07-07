<?php

namespace App\BlogBundle\DataFixtures\ORM;

use App\BlogBundle\Entity\Post;
use App\BlogBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle('test');
        $post->setBody('test content');

        $tag = New Tag('test');
        $tag->getPosts()->add($post);
        $post->getTags()->add($tag);

        $manager->persist($post);
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