<?php


class DefaultUtilHelper implements iUtilHelper
{
	
	private  $dataProviderService;
	
	
	 function __construct($iDataProviderService)
	  {
	    $this->dataProviderService = new $iDataProviderService();
	  }
	
	
	public function executeConcourse($participant){}
	

	public function validateCode($code){}
	

	public function validateData($data){}
	
	
}