<?php

namespace Odiseo\ViolettaPromo\Model;

class Model 
{
	protected $createdAt;
	
	
	public function __construct()
	{
		$this->createdAt = new \DateTime("now");	
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}
	
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
}