<?php

namespace mz\InventoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity
 * @UniqueEntity(fields="fileName")
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255)
     */
    private $fileName;

    /**
     * @var \mz\InventoryBundle\Entity\Item
     *
     * @ORM\OneToOne(targetEntity="mz\InventoryBundle\Entity\Item", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $item;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return Image
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set item
     *
     * @param \mz\InventoryBundle\Entity\Item $item
     * @return Image
     */
    public function setItem(\mz\InventoryBundle\Entity\Item $item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \mz\InventoryBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}
