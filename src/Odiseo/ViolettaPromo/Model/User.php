<?php

namespace Odiseo\ViolettaPromo\Model;

use Doctrine\Common\Collections\ArrayCollection;




class User extends Model 
{	
	protected $id;
	protected $dni;
	protected $fullname;
	protected $email;
	protected $phone;
	protected $participations;
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->participations = new ArrayCollection();
	}
	
	public function setId($id)
	{
		$this->id = $id;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setDni($dni)
	{
		$this->dni = $dni;
	}
	
	public function getDni()
	{
		return $this->dni;
	}
	
	public function setFullname($fullname)
	{
		$this->fullname = $fullname;
	}
	
	public function getFullname()
	{
		return $this->fullname;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
	public function getPhone()
	{
		return $this->phone;
	}
}