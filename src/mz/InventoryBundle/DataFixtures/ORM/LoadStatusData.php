<?php

namespace mz\InventoryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventoryBundle\Entity\Status;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {

        $status1 = new Status();
        $status1->setName('Archivado');
        $status1->setDisplay('');
        
        $status2 = new Status();
        $status2->setName('En Uso');
        $status2->setDisplay('label-success');

        $status3 = new Status();
        $status3->setName('En Reparación');
        $status3->setDisplay('label-important');
        
        $em->persist($status1);
        $em->persist($status2);
        $em->persist($status3);

        $em->flush();

        $this->addReference('status1', $status1);
        $this->addReference('status2', $status2);
        $this->addReference('status3', $status3);
    }

    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}