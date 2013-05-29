<?php

namespace mz\InventoryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventoryBundle\Entity\Condition;

class LoadConditionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {

        $condition1 = new Condition();
        $condition1->setName('Regular');
        $condition1->setDisplay('');
        
        $condition2 = new Condition();
        $condition2->setName('Bueno');
        $condition2->setDisplay('label-success');

        $condition3 = new Condition();
        $condition3->setName('Malo');
        $condition3->setDisplay('label-important');
        
        $em->persist($condition1);
        $em->persist($condition2);
        $em->persist($condition3);

        $em->flush();

        $this->addReference('condition1', $condition1);
        $this->addReference('condition2', $condition2);
        $this->addReference('condition3', $condition3);
    }

    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

}