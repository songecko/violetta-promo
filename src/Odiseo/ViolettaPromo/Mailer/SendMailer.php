<?php

namespace Odiseo\ViolettaPromo\Mailer;
//require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
//use Odiseo\LanBundle\Entity\User as User;

class SendMailer
{
	private $message;
	private $container;
	
	public function __construct(Container $container){
		$this->message = \Swift_Message::newInstance();
		$this->container = $container;
	}

	public function sendWinnerMail($winner, $emailTo,$body)
	{	
		$message = $this->getMessage($winner, $emailTo,$body);
		
		$failures = $this->send($message);
		
		return $failures;
	}
	
	protected function send($message)
	{
		$failures = array();
		$transport = \Swift_SmtpTransport::newInstance('localhost', 25);
       	
		$mailer = \Swift_Mailer::newInstance($transport);
		$mailer->send($message, $failures);
		
		return $failures;
	}	
	
	
	private function getMessage($winner, $emailTo, $body)
	{
		$fullname = $winner['fullname'];
		$email = $winner['email'];
		
		return $this->message
			->setSubject('Gum / Violetta - Nuevo ganador')
			->setFrom(array($email => $fullname))
			->setTo($emailTo)
			->setBody($body, 'text/html');
	}
}