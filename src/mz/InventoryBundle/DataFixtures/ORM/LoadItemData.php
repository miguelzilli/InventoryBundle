<?php

namespace mz\InventoryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventoryBundle\Entity\Item;

class LoadItemData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $min = strtotime('2012-01-01');
        $max = strtotime('2012-12-31');
        $lorem = '\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.';

        for ($i = 1; $i <= 10; $i++) {
            $x = rand(1, 3);
            $date = date('Y-m-d', rand($min, $max));

            $item = new Item();
            $item->setCategory($em->merge($this->getReference('category1')));
            $item->setInventoryCode('MNT001-0000' . $i);
            $item->setCondition($em->merge($this->getReference('condition' . $x)));
            $item->setPurchasePrice(0.01*rand(80000, 300000));
            $item->setDescription('Descripción del item #' . $i . substr($lorem, 0, rand(3,1170)));
            $item->setStatus($em->merge($this->getReference('status' . $x)));
            $item->setPurchaseDate(new \DateTime($date));
            $item->setWarranty($i);
            $item->setBrand('Genérico');
            $item->setModel('Genérico');
            $item->setName('Monitor' . $i);
            $item->setSerialNumber('abc' . $i);
            $item->setLocation($em->merge($this->getReference('location' . $x)));
            
            $item->setCreatedAt(new \DateTime());
            $item->setUpdatedAt(new \DateTime());
            $item->setCreatedBy('[CHANGE]');
            $item->setUpdatedBy('[CHANGE]');

            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }

        for ($i = 11; $i <= 20; $i++) {
            $x = rand(1, 3);
            $date = date('Y-m-d',rand($min, $max));

            $item = new Item();
            $item->setCategory($em->merge($this->getReference('category2')));
            $item->setInventoryCode('KBR001-0000' . $i);
            $item->setCondition($em->merge($this->getReference('condition' . $x)));
            $item->setPurchasePrice(0.01*rand(2000, 30000));
            $item->setDescription('Descripción del item #' . $i . substr($lorem, 0, rand(1,1170)));
            $item->setStatus($em->merge($this->getReference('status' . $x)));
            $item->setPurchaseDate(new \DateTime($date));
            $item->setWarranty($i);
            $item->setBrand('Genérico');
            $item->setModel('Genérico');
            $item->setName('Teclado' . $i);
            $item->setSerialNumber('def' . $i);
            $item->setLocation($em->merge($this->getReference('location' . $x)));

            $item->setCreatedAt(new \DateTime());
            $item->setUpdatedAt(new \DateTime());
            $item->setCreatedBy('[CHANGE]');
            $item->setUpdatedBy('[CHANGE]');

            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }

        for ($i = 21; $i <= 30; $i++) {
            $x = rand(1, 3);
            $date = date('Y-m-d',rand($min, $max));
            
            $item = new Item();
            $item->setCategory($em->merge($this->getReference('category3')));
            $item->setInventoryCode('NBK001-0000' . $i);
            $item->setCondition($em->merge($this->getReference('condition' . $x)));
            $item->setPurchasePrice(0.01*rand(300000, 1500000));
            $item->setDescription('Descripción del item #' . $i . substr($lorem, 0, rand(1,1170)));
            $item->setStatus($em->merge($this->getReference('status' . $x)));
            $item->setPurchaseDate(new \DateTime($date));
            $item->setWarranty($i);
            $item->setBrand('Genérico');
            $item->setModel('Genérico');
            $item->setName('Notebook' . $i);
            $item->setSerialNumber('ghi' . $i);
            $item->setLocation($em->merge($this->getReference('location' . $x)));
            
            $item->setCreatedAt(new \DateTime());
            $item->setUpdatedAt(new \DateTime());
            $item->setCreatedBy('[CHANGE]');
            $item->setUpdatedBy('[CHANGE]');

            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }
    }

    public function getOrder() {
        return 5; // the order in which fixtures will be loaded
    }

}