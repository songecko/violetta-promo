<?php


namespace Odiseo\ViolettaPromo\ServicesImpl;
use Odiseo\ViolettaPromo\Services\iDataProviderService;
use Odiseo\ViolettaPromo\Model\Product;
use  Gecky\Database\Db;
class  DoctrineDbService implements iDataProviderService
{
	
	
	private  $db;
	
	function __construct($Db)
	{
		$this->db = $Db;
	}
	
	public function findAllParticpants(){}
	
	public function insertParticipant($user){
		$em = $this->db->getEntityManager();
		$em->persist($user);
		$em->flush();
		return $user;
	}
	
	public function findParticipantByDni($dni){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\User');
		$dbUser = $repository->findOneByDni($dni);
		return $dbUser;
	}
	
	
	public function countParticipants(){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\User');
		return $repository->createQueryBuilder('id')
		->select('COUNT(id)')
		->getQuery()
		->getSingleScalarResult();
	}
	
	
	public function findAvailablesProductForTodayMinusDays( $plusDayExpresion = '0'){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\ProductAvailable');
		$repository->findByDate( new \DateTime($plusDayExpresion) );
	}
	
	public function findProductAvailabilityByProductId($idProduct){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\ProductAvailable');
		return $repository->findBy(array('product' => $idProduct))[0];
	}
	
	
	public function findAllProducts(){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\Product');
		return $repository->findAll();
	}
	
	
	public function updateProductAvailability($productAvailable){
		$em = $this->db->getEntityManager();
		$em->persist($productAvailable);
		$em->flush();
		return $productAvailable;
	}
	
	public function findWinners(){}
	
	
	public function insertWinner($winner){}
	
	
	public function insertUserParticipation($userParticipation){
		$em = $this->db->getEntityManager();
		$em->persist($userParticipation);
		$em->flush();
		return $userParticipation;
	}
	
	
	public function findParticipationByUserId($user_id, $date ){
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\UserParticipation');
		$date == null ? new \DateTime() : $date;
		return $repository->findBy(array('user' => $user_id , 'createdAt' => $date))[0];
		
	}
	
	
	
	
}