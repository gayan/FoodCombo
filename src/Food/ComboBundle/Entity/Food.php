<?php

namespace Food\ComboBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Food
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Food\ComboBundle\Entity\FoodRepository")
 */
class Food
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
     * @var string
     *
     * @ORM\Column(name="foodName", type="string", length=255)
     */
    protected $foodName;

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
     * Set foodName
     *
     * @param string $foodName
     * @return Food
     */
    public function setFoodName($foodName)
    {
        $this->foodName = $foodName;
    
        return $this;
    }

    /**
     * Get foodName
     *
     * @return string 
     */
    public function getFoodName()
    {
        return $this->foodName;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Food
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
     * @return Food
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