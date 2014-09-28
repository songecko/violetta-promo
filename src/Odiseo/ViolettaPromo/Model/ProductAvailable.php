<?php

namespace Odiseo\ViolettaPromo\Model;

class ProductAvailable extends Model
{	
	protected $id;
	protected $date;
	protected $product;
	protected $quantity;
	
	public function setId($id)
	{
		$this->id = $id;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setDate($date)
	{
		$this->date = $date;
	}
	
	public function getDate()
	{
		return $this->date;
	}
	
	public function setProduct(Product $product)
	{
		$this->product = $product;
	}
	
	public function getProduct()
	{
		return $this->product;
	}
	
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
	
	public function getQuantity()
	{
		return $this->quantity;
	}
}