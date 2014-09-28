<?php

namespace Odiseo\ViolettaPromo\Model;

/**
 * Users participations. This entity should be created when a user participate to the promo, setting the user and the promo code.
 * If the user win, the instance will have also the product reference, else, it reference should be null.
 */
class UserParticipation extends Model 
{	
	protected $id;
	protected $user;
	protected $code;
	protected $product;
	
	public function setId($id)
	{
		$this->id = $id;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	public function getUser()
	{
		return $this->user;
	}
	
	public function setCode(Code $code)
	{
		$this->code = $code;
	}
	
	public function getCode()
	{
		return $this->code;
	}
	
	public function setProduct(Product $product)
	{
		$this->product = $product;
	}
	
	public function getProduct()
	{
		return $this->product;
	}
}