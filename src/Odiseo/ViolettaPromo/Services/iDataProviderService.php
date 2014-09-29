<?php

/**
 *  This interface define the standard behaviour for each data provider.
 * @author Petium
 *
 */
interface iDataProviderService
{
	
	const SERVICE_NAME = "DATA_PROVIDER_SERVICE";    
	 
	/**
	 * This method is to retrive the list of participation
	*@return array of {@link UserParticipation.php }
	*/
	public function findAllParticpants();
	
	public function insertParticipantById($participant);
	
	public function findParticipant($id);
	 
	public function findAvailablesProductForToday();
	
	public function updateProductAvailability($product);
	
	public function findWinners();
	
	public function insertWinner($winner);
	
		
}
