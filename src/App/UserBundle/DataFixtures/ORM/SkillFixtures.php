<?php

namespace App\UserBundle\DataFixtures\ORM;

use App\UserBundle\Entity\Skill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SkillFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $skill = new Skill('PHP',90);
        $manager->persist($skill);

        $skill = new Skill('HTML & CSS & Javascript',70);
        $manager->persist($skill);

        $skill = new Skill('Java',70);
        $manager->persist($skill);

        $skill = new Skill('C#',60);
        $manager->persist($skill);

        $skill = new Skill('Objective C',30);
        $manager->persist($skill);

        $skill = new Skill('Swift',15);
        $manager->persist($skill);

        $manager->flush();

//        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}