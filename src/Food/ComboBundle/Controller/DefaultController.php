<?php

namespace Food\ComboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	
    public function indexAction($foodName)
    {
		if($foodName == "_")
		{
			$food = $this->getDoctrine()
				->getRepository('FoodComboBundle:Food')
				->getLatestOne();
			$foodName = $food->getFoodName();
		}
		
		$matchingCombos = $this->getDoctrine()
			->getRepository('FoodComboBundle:Combo')
			->getCombosWith($food);
		
        return $this->render('FoodComboBundle:Default:index.html.twig', array(
																		"foodName1" => $foodName,
																		"matchingCombos" => $matchingCombos));
    }
}
