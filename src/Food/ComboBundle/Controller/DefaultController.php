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
			$foodName = $food->getName();
		}
		
		// TODO: get all combos with this food.
		
        return $this->render('FoodComboBundle:Default:index.html.twig', array("foodName1" => $foodName));
    }
}
