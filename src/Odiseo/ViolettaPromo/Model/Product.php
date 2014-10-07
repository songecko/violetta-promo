<?php

namespace Odiseo\ViolettaPromo\Model;

class Product extends Model 
{	
	protected $id;
	protected $name;
	protected $dateInit;
	protected $step;
	protected $increment;
	
	public function setId($id)
	{
		$this->id = $id;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	
	public function getDateInit(){
		return $this->dateInit;
	}
	
	public function setDateInit($dateInit){
		$this->dateInit = $dateInit;
	}
	
	public function getStep(){
		return $this->step;
	}
	
	public function setStep($step){
		$this->step = $step;
	}
	
	public function getIncrement(){
		return $this->increment;
	}
	
	public function setIncrement($increment){
		$this->increment =$increment;	
	}
	
	
}