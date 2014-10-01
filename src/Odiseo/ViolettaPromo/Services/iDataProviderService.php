<?php


namespace Odiseo\ViolettaPromo\Services;

use Odiseo\ViolettaPromo\Model\ProductAvailable;
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
	
	public function insertParticipant($user);
	
	public function findParticipantByDni($dni);
	 
	/**
	 * @param $plusDayExpresion -> plus expression i.e : '-1 day' or '+3 day'
	 * @return  array of records with date =  (today + $plusDayExpresion )
	 */
	public function findAvailablesProductForTodayMinusDays( $plusDayExpresion );
	
	public function updateProductAvailability($productAvailable);
	
	public function findWinners();
	
	public function findProductById($id);
	
	public function updateParcipantToWinner($winner);
	
	public function countParticipants();
	
	/**
	 * @param integer $idProduct
	 * @return last record on db for ProductAvailable
	 */
	
	public function findProductAvailabilityByProductId($idProduct);
	
	/**
	 * 
	 * @return array[producst]
	 */
	public function findAllProducts();
	
	/**
	 * registra un nuevo participante
	 */	
	public function insertUserParticipation($userParticipation);
	
	
	public function findParticipationBy($user_id , $code_id, $date);
	
		
}
