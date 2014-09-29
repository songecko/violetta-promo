<?php

namespace Odiseo\ViolettaPromo\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\YamlDriver;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;

class ConfigurationApp {
	
	private $properties = array();
	
	public function init($container){
		
		$db = $container->get('database');
		$em = $db->getEntityManager();
		$codes = $em->getRepository('Odiseo\ViolettaPromo\Model\Code')->findAll();
		$this->properties['validCodes'] = 	$codes;
	}
	
	public function getProperty($key){
		return $this->properties[$key];
	}

}