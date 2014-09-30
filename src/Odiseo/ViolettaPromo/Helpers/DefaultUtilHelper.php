<?php

namespace Odiseo\ViolettaPromo\Helpers;
use Odiseo\ViolettaPromo\Helpers\iUtilHelper;


class DefaultUtilHelper implements iUtilHelper
{
	
	const VALUE_WINNER = 0;
	const PRODUCTS_BY_DAY = 3;
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
 				return true;
 		}
 		return false;
	}
	public function validateData($data){
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Odiseo\ViolettaPromo\Helpers\iUtilHelper::executeConcourse()
	 */
	public function executeConcourse($user){
		
		$registeredUser = $this->dataProviderService->findParticipantByDni($user->getDni());
		if ($registeredUser == null){
			$user =  $this->dataProviderService->insertParticipant($user);
		}
		$participantsQuantity = $this->dataProviderService->countParticipants();
		$hash_productId_prdAvailability = $this->getAvailableProducts();
		foreach ($hash_productId_prdAvailability as $key => $value) {
			$lastProductAvailability = $hash_productId_prdAvailability[$key];
			$productQuantity = $lastProductAvailability->getQuantity();
			if ($productQuantity > 0){
				$isWinner = $this->doRandom($participantsQuantity, $productQuantity);
				if ($isWinner){
					$lastProductAvailability->setQuantity( $productQuantity - 1);
					$this->dataProviderService->updateProductAvailability($lastProductAvailability);
					return $lastProductAvailability->getProduct();
				}
			}
		}
		return null;
	}
	
	private function getAvailableProducts(){
		$allProducst = $this->dataProviderService->findAllProducts();
		$hash_product_availability = array();
	
		foreach ($allProducst as $product) {
			//por configuración siempre hay un registro
			$lastAvailability = $this->dataProviderService->findProductAvailabilityByProductId($product->getId());
			
			$now = new \DateTime();
			$diff = $now->diff($lastAvailability->getDate());
			
			// si tiene fecha de hoy. Es la cantidad que necesito diff= 0 ==> no suma nada 
			$newAvailability = $diff * $this->PRODUCTS_BY_DAY;
			$lastAvailability->setQuantity($newAvailability);
			
			$hash_product_availability( $product->getId() ) = $lastAvailability;
		}
		return $hash_product_availability;
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
		if ( $this->VALUE_WINNER == $valueRaffled){
			return true;
		}
		return false;
	}
	
	
}