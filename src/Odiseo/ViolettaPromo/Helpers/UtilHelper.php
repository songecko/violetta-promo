<?php


public class DefaultUtilHelper implements iUtilHelper
{
	
	private iDataProviderService dataProviderService = new DoctrineDbService();
	
	
	 function __construct($iDataProviderService)
	  {
	    $this->dataProviderService = $iDataProviderService;
	  }
	
	
	public function executeConcourse($participant){}
	

	public function validateCode($code){}
	

	public function validateData($data){}
	
	
}