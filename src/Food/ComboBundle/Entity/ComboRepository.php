<?php

namespace Food\ComboBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ComboRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComboRepository extends EntityRepository
{
	public function getCombosWith($food)
	{
		$query = $this->getEntityManager()
			->createQuery('
				SELECT c FROM FoodComboBundle:Combo c, FoodComboBundle:Food f
				WHERE (f.id = :foodId) and (c.food1 = f or c.food2 = f)
				ORDER BY c.id desc')->setParameter('foodId', $food);
		
		return $query->getResult();
	}
}
