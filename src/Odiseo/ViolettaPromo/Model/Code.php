<?php

namespace Odiseo\ViolettaPromo\Model;

class Code extends Model 
{	
	protected $id;
	protected $code;
	
	public function setId($id)
	{
		$this->id = $id;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setCode($code)
	{
		$this->code = $code;
	}
	
	public function getCode()
	{
		return $this->code;
	}
}