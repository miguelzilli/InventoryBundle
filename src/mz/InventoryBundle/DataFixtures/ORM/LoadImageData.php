<?php

namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        // for ($i=1; $i < 17; $i++) { 
        //     $img=new Imagen();
        //     $img->setPath('00'.$i.'.jpg');
        //     $img->setItem($em->merge($this->getReference('item'.$i)));
        //     $em->persist($img);
        // }
        // for ($i=1; $i < 17; $i++) { 
        //     $img=new Imagen();
        //     $img->setPath('00'.$i.' (copia).jpg');
        //     $img->setItem($em->merge($this->getReference('item'.$i)));
        //     $em->persist($img);
        // }
        // $em->flush();
    }

    public function getOrder() {
        return 6; // the order in which fixtures will be loaded
    }

}