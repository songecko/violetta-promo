<?php


namespace Odiseo\ViolettaPromo\ServicesImpl;

use Odiseo\ViolettaPromo\Services\iDataProviderService;
use Odiseo\ViolettaPromo\Model\Product;
use  Gecky\Database\Db;

class DoctrineDbService implements iDataProviderService
{
	private  $db;
	
	function __construct($Db)
	{
		$this->db = $Db;
	}
	
	public function findAllParticpants(){}
	
	public function insertParticipant($user)
	{
		$em = $this->db->getEntityManager();
		$em->persist($user);
		$em->flush();
		return $user;
	}
	
	public function findParticipantByDni($dni)
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\User');
		$dbUser = $repository->findOneByDni($dni);
		return $dbUser;
	}
	
	
	public function countParticipants()
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\User');
		return $repository->createQueryBuilder('id')
		->select('COUNT(id)')
		->getQuery()
		->getSingleScalarResult();
	}
	
	public function findAvailablesProductForTodayMinusDays( $plusDayExpresion = '0')
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\ProductAvailable');
		$repository->findByDate( new \DateTime($plusDayExpresion) );
	}
	
	public function findProductAvailabilityByProductId($idProduct)
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\ProductAvailable');
		$productsAvailibility = $repository->findOneBy(array('product' => $idProduct));
		
		return $productsAvailibility;
	}
	
	public function findAllProducts()
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\Product');
		return $repository->findAll();
	}

	
	public function updateProductAvailability($productAvailable)
	{
		$em = $this->db->getEntityManager();
		$em->merge($productAvailable);
		$em->flush();
		return $productAvailable;
	}
	
	public function findWinners(){}
	
	public function findProductById($id)
	{
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\Product');
		return $repository->findOneById($id);
	}
	
	public function updateParcipantToWinner($winner)
	{
		$em = $this->db->getEntityManager();
		$em->merge($winner);
		$em->flush();
	}
	
	public function insertUserParticipation($userParticipation)
	{
		$em = $this->db->getEntityManager();
		$em->persist($userParticipation);
		$em->flush();
		return $userParticipation;
	}
	
	public function findParticipationBy($user_id, $code_id, $date)
	{
		$dateFormatted = $date->format('Y-m-d');
		$em = $this->db->getEntityManager();
		$repository = $em->getRepository('Odiseo\ViolettaPromo\Model\UserParticipation');
		
		$qb = $repository->createQueryBuilder('up');
		$qb->select('up')->where('up.user = :user_id')
		->andWhere('up.code = :code_id')->andWhere('up.createdAt >= :today')//'2014-09-30'
		->setParameters(array('user_id' => $user_id, 'code_id' => $code_id ,'today' => $dateFormatted ));
		
		try {
			$result = $qb->getQuery()->getSingleResult();
		}catch (\Exception $e)
		{
			$result = null;
		}
		
		return $result;
	}
	
	
	
	
}