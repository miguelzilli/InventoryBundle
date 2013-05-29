<?php
namespace mz\InventoryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventoryBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $category1 = new Category();
        $category1->setName('Monitores');

        $category2 = new Category();
        $category2->setName('Teclados');

        $category3 = new Category();
        $category3->setName('Notebooks');

        $em->persist($category1);
        $em->persist($category2);
        $em->persist($category3);

        $em->flush();

        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}