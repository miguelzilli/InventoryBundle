<?php

namespace mz\InventoryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventoryBundle\Entity\Location;

class LoadLocationData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $location1 = new Location();
        $location1->setName('Oficina 1');
        
        $location2 = new Location();
        $location2->setName('Oficina 2');
        
        $location3 = new Location();
        $location3->setName('Oficina 3');
        
        $em->persist($location1);
        $em->persist($location2);
        $em->persist($location3);
        
        $em->flush();
        
        $this->addReference('location1', $location1);
        $this->addReference('location2', $location2);
        $this->addReference('location3', $location3);
    }

    public function getOrder() {
        return 4; // the order in which fixtures will be loaded
    }

}