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
	
	/**
	 *  Registra un nuevo participante
	 * @param unknown $dni 
	 * @param unknown $validcode class Code
	 */
	public function registerParticipant($dni, $validCode);
	
	/**
	 * 
	 * @param UserParticipation $userParticipation
	 * @return null if user is not able to partcipate today.
	 * @return UserParticipation if user is able to participate.
	 */
	public function insertUserParticipation($userParticipation);
}