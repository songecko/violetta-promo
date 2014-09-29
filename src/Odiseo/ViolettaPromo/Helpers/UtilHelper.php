<?php

namespace Odiseo\ViolettaPromo\Helpers;
use Odiseo\ViolettaPromo\Helpers\iUtilHelper;


class DefaultUtilHelper implements iUtilHelper
{
	
	private  $dataProviderService;
	private  $validCodes = array();
	
	
	function __construct($iDataProviderService, $configuration)
	  {
	    $this->dataProviderService = $iDataProviderService;
	    $this->$validCodes = $configuration->getProperty('validCodes');
	    
	  }
	
 	public function validateCode($code){
		
 		foreach ($this->validCodes as $validCode) {
 			if ($validCode ==  $code)
 				return true;
 		}
 		return false;
	}
	

	public function validateData($data){
		
		
	}
	
	
	public function executeConcourse($participant){
	
	
	
	
	}
	
	
	
}