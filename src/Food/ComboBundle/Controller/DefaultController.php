<?php

namespace Food\ComboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Food\ComboBundle\Entity\Food;
use Food\ComboBundle\Entity\Combo;

class DefaultController extends Controller
{

	const HTTP_OK = 200;
	const HTTP_BAD_REQUEST = 400;
	const HTTP_INTERNAL_SERVER_ERROR = 500;
	
    public function indexAction($foodName)
    {
		if($foodName != "_")
		{
            $food = $this->getDoctrine()
							->getRepository('FoodComboBundle:Food')
							->search($foodName);
		}
        
        if(!isset($food)) {
            $food = $this->getDoctrine()
				->getRepository('FoodComboBundle:Food')
				->getLatestOne();
        } else {
            $food = $food[0];
        }
        
        return $this->render('FoodComboBundle:Default:index.html.twig', array(
																		"food1" => $food));
	}
    
    public function getComboAction($comboId)
    {
        $combo = $this->getDoctrine()
                ->getRepository('FoodComboBundle:Combo')
                ->findOneById($comboId);
                
        if(!$combo)
        {
            throw $this->createNotFoundException('The combo does not exist');
        }
        
        return $this->render('FoodComboBundle:Default:combo.html.twig', array("combo" => $combo));
    }
    
	public function addComboAction($food1, $food2)
	{
		$em = $this->getDoctrine()->getManager();
		
		$food1Entity = null;
		if(is_numeric($food1))
		{
			$food1Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->findOneById($food1);
			if($food1Entity == null)
			{
				return $this->jsonResponse("Food id invalid $food1", self::HTTP_BAD_REQUEST);
			}
		}
		else {
			$food1Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->findOneByFoodName($food1);
			if($food1Entity == null)
			{
				$food1Entity = new Food();
				$food1Entity->setFoodName($food1);
				$food1Entity->setCreatedBy($_SERVER['REMOTE_ADDR']);
				$em->persist($food1Entity);
			}
		}
		
		$food2Entity = null;
		if(is_numeric($food2))
		{
			$food2Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->findOneById($food2);
			if($food2Entity == null)
			{
				return $this->jsonResponse("Food id invalid $food2", self::HTTP_BAD_REQUEST);
			}
		}
		else {
			$food2Entity = $this->getDoctrine()
								->getRepository('FoodComboBundle:Food')
								->findOneByFoodName($food2);
			if($food2Entity == null)
			{
				$food2Entity = new Food();
				$food2Entity->setFoodName($food2);
				$food2Entity->setCreatedBy($_SERVER['REMOTE_ADDR']);
				$em->persist($food2Entity);
			}
		}
		
		// create a new combo
		$newCombo = new Combo();
		$newCombo->setFood1($food1Entity);
		$newCombo->setFood2($food2Entity);
		$newCombo->setcreatedBy($_SERVER['REMOTE_ADDR']);
		
		
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
