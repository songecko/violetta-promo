<?php

namespace Odiseo\ViolettaPromo\Helpers;

/**
 * This interface defines behaviour for utilites helpers functions.
 * @author Uusuario
 *
 */
interface iUtilHelper
{
	
	const SERVICE_NAME = 'util_helper';
	/**
	 * @return	boolean saying if the participan won or not. 
	 */
	public function executeConcourse($participant);
	
	/**
	 * @return boolean saying if the code is valid.
	 */
	public function validateCode($code);
	
	/**
	 * @return boolean saying if the code is valid.
	 */
	public function validateData($data);
	
	
}