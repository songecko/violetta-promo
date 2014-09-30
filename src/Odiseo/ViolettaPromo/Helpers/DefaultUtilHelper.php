<?php

namespace Odiseo\ViolettaPromo\Helpers;
use Odiseo\ViolettaPromo\Helpers\iUtilHelper;
use Odiseo\ViolettaPromo\Model\User;
use Odiseo\ViolettaPromo\Model\UserParticipation;


class DefaultUtilHelper implements iUtilHelper
{
	
	const VALUE_WINNER = 0;
	const PRODUCTS_PER_DAY = 3;
	private  $dataProviderService;
	private  $validCodes = array();
	
	
	function __construct($iDataProviderService, $configuration)
	  {
	    $this->dataProviderService = $iDataProviderService;
	    $this->validCodes = $configuration->getProperty('validCodes');
	    
	  }
 	
 	public function validateCode($code){
		foreach ($this->validCodes as $validCode) {
 			if ($validCode->getCode() ==  $code)
 				return $validCode;
 		}
 		return null;
	}
	
	public function validateData($data){
		
	}
	
	public function registerParticipant($dni, $validCode){
		
		$registeredUser = $this->dataProviderService->findParticipantByDni($dni);
		if ($registeredUser == null){
			$user = new User();
			$user->setDni($dni);
			$registeredUser =  $this->dataProviderService->insertParticipant($user);
		}
		return $registeredUser;
	}
	
	public function participate($registeredUser, $validCode){
		$userParticipation = $this->dataProviderService->findParticipationByUserId($registeredUser->getId());
		
		if ($userParticipation != null)//ya participo este día
			return null;
		else{//registro nueva participación
			$userParticipation  = new UserParticipation();
			$userParticipation->setUser($registeredUser);
			$userParticipation->setCode($validCode);
			$this->dataProviderService->insertUserParticipation($userParticipation);
			return $userParticipation;
		}
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see \Odiseo\ViolettaPromo\Helpers\iUtilHelper::executeConcourse()
	 */
	public function executeConcourse($user){
		
		$participantsQuantity = $this->dataProviderService->countParticipants();
		
		$productsAvailability = $this->getProductsAvailability();
	
		foreach ($productsAvailability as $prdAvailability) {
			$productQuantity = $prdAvailability->getQuantity();
			if ($productQuantity > 0){
				$isWinner = $this->doRandom($participantsQuantity, $productQuantity);
				if ($isWinner){
					$prdAvailability->setQuantity( $productQuantity - 1);
					
					$this->dataProviderService->updateProductAvailability($prdAvailability);
					return $prdAvailability->getProduct();
				}
			}
		}
		return null;
	}
	
	private function getProductsAvailability(){
		$allProducst = $this->dataProviderService->findAllProducts();
		$productsAvailability = array();
		foreach ($allProducst as $product) {
			//por configuración siempre hay un registro
			$lastAvailability = $this->dataProviderService->findProductAvailabilityByProductId($product->getId());
			$now = new \DateTime();
			$diff = $now->diff($lastAvailability->getDate());
			
			//updateQuantity
			// si tiene fecha de hoy. Es la cantidad que necesito diff= 0 ==> no suma nada 
			$newAvailability = $lastAvailability->getQuantity() +  $diff->days * self::PRODUCTS_PER_DAY;
			d($newAvailability);
		    $lastAvailability->setQuantity($newAvailability);
		    //updateDate to today.
			$now = new \DateTime();
			$lastAvailability->setDate($now);
			$this->dataProviderService->updateProductAvailability($lastAvailability);
			$productsAvailability[] = $lastAvailability;
		}
		return $productsAvailability;
	}

	
	
	/**
	 * Each parcipant has probability to win betweenn 0 and ($participantQuantity / $productQuantity)
	 * only if $productQunatity > 0 and $participantQuantity > 0
	 * @param unknown $participantQuantity
	 * @param unknown $productQuantity
	 */
	private function doRandom($participantsQuantity, $productQuantity){
		
		if ($participantsQuantity == 0) return true;
		$randomRange = $participantsQuantity / $productQuantity;
		$valueRaffled = rand(0 ,$randomRange );
		if (  self::VALUE_WINNER == $valueRaffled){
			return true;
		}
		return false;
	}
	
	
}