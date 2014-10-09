<?php

namespace Odiseo\ViolettaPromo\Helpers;
use Odiseo\ViolettaPromo\Helpers\iUtilHelper;
use Odiseo\ViolettaPromo\Model\User;
use Odiseo\ViolettaPromo\Model\UserParticipation;
use Odiseo\ViolettaPromo\Model\ProductAvailable;


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
		
		$today =  new \DateTime()  ;
		$userParticipation = $this->dataProviderService->findParticipationBy($registeredUser->getId(),$validCode->getId(),  $today  );
		
		if ($userParticipation != null)//ya participo este día
		{		//////////////////////////////////////
			return null;
		}
		else{
			//registro nueva participación
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
	public function executeConcourse($user, $userParticipation){
		$participantsQuantity = $this->dataProviderService->countParticipants();
		
		$productsAvailability = $this->getProductsAvailabilityForConcourse();
		foreach ($productsAvailability as $prdAvailability) {
			$productQuantity = $prdAvailability->getQuantity();
			if ($productQuantity > 0){
				$isWinner = $this->doRandom($participantsQuantity, $productQuantity);
				if ($isWinner){
					
					$prdAvailability->setQuantity( $productQuantity - 1);
					$this->dataProviderService->updateProductAvailability($prdAvailability);
					$userParticipation->setProduct($prdAvailability->getProduct());
					$this->dataProviderService->updateParcipantToWinner($userParticipation);
					return $prdAvailability->getProduct();
				}
			}
		}
		return null;
	}
	
	private function getProductsAvailabilityForConcourse(){
		$allProducst = $this->dataProviderService->findAllProducts();
		$productsAvailability = array();
		foreach ($allProducst as $product) {
			
			$availability = $this->getAvailability($product);
			if( $availability != null)
			$productsAvailability[] = $availability;
			
		}
		return $productsAvailability;
	}
	
	
	private function getAvailability($product){
		$now = new \DateTime();
		if ( $now >= $product->getDateInit() )
		{		
			
		
			$lastAvailability = $this->dataProviderService->findProductAvailabilityByProductId($product->getId());
			if ($lastAvailability != null){
				// si es de hoy,  diff = no hace falta actualizar nada
				$diff = $now->diff( $lastAvailability->getDate() );
				if ($diff->days ==  0){
					return $lastAvailability;
				}
					
				$itShouldBeUpdatedOnDate = $this->calculateLastDateToUpdateInTheory( $product->getDateInit() ,$now, $product->getStep() );
				$increment = $this->calculateIncrement( $lastAvailability->getDate(),$itShouldBeUpdatedOnDate,$product->getStep(), $product->getIncrement()  );
				
				$lastAvailability->setDate($now);
				$newQuantity = $lastAvailability->getQuantity() + $increment;
				$lastAvailability->setQuantity($newQuantity);
				$this->dataProviderService->updateProductAvailability($lastAvailability);
				return $lastAvailability;
			}

			else
			{
			
				$itShouldBeUpdatedOnDate = $this->calculateLastDateToUpdateInTheory( $product->getDateInit() ,$now, $product->getStep() );
				$newIncrement = $this->calculateIncrement( $product->getDateInit(),$itShouldBeUpdatedOnDate,$product->getStep(), $product->getIncrement()  );
				$lastAvailability = new ProductAvailable();
				$lastAvailability->setDate($now);
				$lastAvailability->setProduct($product);
				$lastAvailability->setQuantity($product->getIncrement() + $newIncrement);
				$this->dataProviderService->updateProductAvailability($lastAvailability);
				return $lastAvailability;
			}
		}
		return null;
	}
	/**
	 * @return la ultima fecha dónde se debería haber actualizado de acuerdo a los steps.
	 * Steps para cd -> "cada dos días"
	 * steps para mochila -> "cada 6 días". 
	 */
	private function calculateLastDateToUpdateInTheory($dateInit, $today, $step){
		
		$daysDifference = $today->diff( $dateInit)->days;
		$restOfDivision = $daysDifference %  $step;
		$valueToModify = '-'.($restOfDivision).' day';
		$dateToUpdate = $today->modify($valueToModify);
		return $dateToUpdate;
		
	}
	
	/**
	 * Calcula el incremento en la disponibilidad del producto de acuerdo al "step" y al valueToIncrement
	 * Cada "6 dias" ( step ) se debe agregar 1(value to increment)  mochila 
	 * 
	 * @param unknown $dateInit
	 * @param unknown $lastDateUpdatedReal
	 * @param unknown $lastDateToUpdateInTheory
	 * @param unknown $step
	 * @param unknown $valueToIncrement
	 */
	private function calculateIncrement( $lastDateUpdatedReal, $itShouldBeUpdatedOnDate, $step, $valueToIncrement){
		 
		$difference = $lastDateUpdatedReal->diff($itShouldBeUpdatedOnDate)->days;
		
		$entire_part = floor($difference / $step);
		
		$increment = $entire_part * $valueToIncrement;
		

		return $increment;
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
