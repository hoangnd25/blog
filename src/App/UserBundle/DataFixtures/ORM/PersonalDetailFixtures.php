<?php

namespace App\UserBundle\DataFixtures\ORM;

use App\UserBundle\Entity\PersonalDetail;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PersonalDetailFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $pd = new PersonalDetail('name','Hoang Nguyen');
        $manager->persist($pd);

        $pd = new PersonalDetail('phone','0415586869');
        $manager->persist($pd);

        $pd = new PersonalDetail('address','Station Street, Box Hill North Victoria 3129 Australia');
        $manager->persist($pd);

        $pd = new PersonalDetail('contact_email','contact@hoangnd.me');
        $manager->persist($pd);

        $pd = new PersonalDetail('map_lon','145.1250310145');
        $manager->persist($pd);

        $pd = new PersonalDetail('map_lat','-37.8099510375');
        $manager->persist($pd);

        $pd = new PersonalDetail('facebook','https://www.facebook.com/hoangnd2510');
        $manager->persist($pd);

        $pd = new PersonalDetail('github','https://github.com/hoangnd25');
        $manager->persist($pd);

        $pd = new PersonalDetail('linkedin','http://au.linkedin.com/in/hoangnd');
        $manager->persist($pd);

        $pd = new PersonalDetail('twitter','');
        $manager->persist($pd);

        $pd = new PersonalDetail('google_plus','');
        $manager->persist($pd);

        $manager->flush();

//        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}