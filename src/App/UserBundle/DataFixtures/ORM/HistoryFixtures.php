<?php

namespace App\UserBundle\DataFixtures\ORM;

use App\UserBundle\Entity\History;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HistoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $history = new History();
        $history->setYear(2008);
        $history->setType(History::EDUCATION);
        $history->setTitle('Higher Diploma of Software Engineering');
        $history->setAt('APROTRAIN APTECH');
        $history->setDescription('I studied Database System, .NET, Java frameworks and other geeky stuffs.');
        $manager->persist($history);

        $history = new History();
        $history->setYear(2012);
        $history->setType(History::EDUCATION);
        $history->setTitle('Diploma of Commerce');
        $history->setAt('DEAKIN UNIVERSITY');
        $history->setDescription('I came to australia and got my Diploma at Deakin.');
        $manager->persist($history);

        $history = new History();
        $history->setYear(2013);
        $history->setType(History::EDUCATION);
        $history->setCurrent(true);
        $history->setTitle('Bachelor of Business Information System');
        $history->setAt('SWINBURNE UNIVERSITY');
        $history->setDescription('I\'m studying my final year. Mostly boring stuffs, but i\'m gonna get my degree soon.');
        $manager->persist($history);

        $history = new History();
        $history->setYear(2012);
        $history->setType(History::WORK);
        $history->setCurrent(true);
        $history->setTitle('Web Developer');
        $history->setAt('RELYIT');
        $history->setDescription('I\'m currently working for RelyIT. My job is to create websites, develop mobile apps and other stuffs.');
        $manager->persist($history);

        $manager->flush();

//        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}