<?php

namespace Food\ComboBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Combo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Food\ComboBundle\Entity\ComboRepository")
 */
class Combo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Food\ComboBundle\Entity\Food
	 *
	 * @ORM\ManyToOne(targetEntity="Food")
     * @ORM\JoinColumn(name="foodId1", referencedColumnName="id")
     */
    protected $food1;

    /**
     * @var \Food\ComboBundle\Entity\Food
     *
	 * @ORM\ManyToOne(targetEntity="Food")
     * @ORM\JoinColumn(name="foodId2", referencedColumnName="id")
     */
    protected $food2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    protected $createdOn;

    /**
     * @var string
     *
     * @ORM\Column(name="createdBy", type="string", length=255)
     */
    protected $createdBy;


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
     * Set food1
     *
     * @param integer $food1
     * @return Combo
     */
    public function setFood1($food1)
    {
        $this->food1 = $food1;
    
        return $this;
    }

    /**
     * Get food1
     *
     * @return integer 
     */
    public function getFood1()
    {
        return $this->food1;
    }

    /**
     * Set food2
     *
     * @param integer $food2
     * @return Combo
     */
    public function setFood2($food2)
    {
        $this->food2 = $food2;
    
        return $this;
    }

    /**
     * Get food2
     *
     * @return integer 
     */
    public function getFood2()
    {
        return $this->food2;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Combo
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Combo
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}