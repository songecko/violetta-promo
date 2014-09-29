<?php


namespace Odiseo\ViolettaPromo\ServicesImpl;
use Odiseo\ViolettaPromo\Services\iDataProviderService;
use  Gecky\Database\Db;
class  DoctrineDbService implements iDataProviderService
{
	
	
	private  $db;
	
	function __construct($Db)
	{
		$this->$db = $Db;
	}
	
	public function findAllParticpants(){}
	
	public function insertParticipantById($participant){}
	
	public function findParticipant($id){}
	
	public function findAvailablesProductForToday(){}
	
	public function updateProductAvailability($product){}
	
	public function findWinners(){}
	
	public function insertWinner($winner){}
	
	
	
	
	
	
}