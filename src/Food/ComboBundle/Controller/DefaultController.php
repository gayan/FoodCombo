<?php

namespace Food\ComboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

	const HTTP_OK = 200;
	const HTTP_BAD_REQUEST = 400;
	const HTTP_INTERNAL_SERVER_ERROR = 500;
	
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
    
	public function addComboAction($food1, $food2)
	{
		$em = $this->getDoctrine()->getManager();
		
		$food1Entity = null;
		if(is_numeric($food1))
		{
			$food1Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->get($food1);
			if($food1Entity == null)
			{
				return $this->jsonResponse("Food id invalid $food1", self::HTTP_BAD_REQUEST);
			}
		}
		else {
			$food1Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->getByName($food1);
			if($food1Entity == null)
			{
				$food1Entity = new Food();
				$food1Entity->setFoodName($food1);
				$em->persist($food1Entity);
			}
		}
		
		$food2Entity = null;
		if(is_numeric($food2))
		{
			$food2Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->get($food2);
			if($food2Entity == null)
			{
				return $this->jsonResponse("Food id invalid $food2", self::HTTP_BAD_REQUEST);
			}
		}
		else {
			$food2Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->getByName($food2);
			if($food2Entity == null)
			{
				$food2Entity = new Food();
				$food2Entity->setFoodName($food2);
				$em->persist($food2Entity);
			}
		}
		
		// create a new combo
		$newCombo = new Combo();
		$newCombo->setFood1($food1Entity);
		$newCombo->setFood2($food2Entity);
		
		
		$em->persist($newCombo);
		$em->flush();
		
		return $this->jsonResponse($newCombo, self::HTTP_OK);
	}
	
	public function searchAction($q)
	{
		$matchingFood = $this->getDoctrine()
							->getRepository('FoodComboBundle:Food')
							->search($q);
		
		return $this->jsonResponse($matchingFood, self::HTTP_OK);
	}
	
	public function getCombosAction($foodId) {
		$matchingCombos = $this->getDoctrine()
			->getRepository('FoodComboBundle:Combo')
			->getCombosWith($foodId);
			
		return $this->jsonResponse($matchingCombos, self::HTTP_OK);
	}
	
	private function jsonResponse($data, $httpCode = 200)
	{
		$serializer = $this->container->get('serializer');
        $serializedData = $serializer->serialize($data, 'json');
		
		$response = new Response($serializedData);
		
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($httpCode);
        
        return $response;
	}
}
