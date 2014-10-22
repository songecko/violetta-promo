<?php

namespace Odiseo\ViolettaPromo\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Gecky\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\DBAL\Query\QueryBuilder;
use Pagerfanta\Adapter\DoctrineDbalSingleTableAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\DefaultView;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Doctrine\DBAL\DBALException;
use Odiseo\ViolettaPromo\Model\User;
use Odiseo\ViolettaPromo\Helpers\iUtilHelper;


class MainController extends Controller
{		
	public function indexAction(Request $request)
	{
		return $this->render('Main/index.php');
	}
	
	public function participateAction(Request $request)
	{
		$dni = $request->request->get('dni');
		$code = $request->request->get('code');
		$iUtilHelper = $this->get(iUtilHelper::SERVICE_NAME);
		
		$validCode = $iUtilHelper->validateCode($code);
		if ($validCode != null)
		{
			$registeredUser = $iUtilHelper->registerParticipant($dni, $validCode);
			$userParticipation = $iUtilHelper->participate($registeredUser, $validCode);
			if ($userParticipation != null) //it is able to participate
			{
				$winProduct = $iUtilHelper->executeConcourse($registeredUser,$userParticipation );
				if ($winProduct != null)
				{
					//Guardo en la session el dni ingresado y el producto ganado
					$_SESSION['last_winner_dni'] = $dni;
					$_SESSION['last_win_product_id'] = $winProduct->getId();
					
					$view = $this->templating->render('Main/ganador.php', array(
							'code' => $code,
							'dni' => $dni,
							'winProduct' => $winProduct
					));
				}
				else
				{
					$view = $this->templating->render('Main/perdedor.php');
				}
			}//it is not able to participate
			else{
				$view = $this->templating->render('Main/repetido.php');
			}
		}
		else{ //mostrare mensaje de error "codigo invalido".
			$view = $this->templating->render('Main/errorParticipating.php', array(
					'message' => "El código ingresado no es valido. ¡Volvé a intentarlo!",
			));
		}
		
		//Return the view, without layout (popup)
		return new Response($view);
	}

	public function updateWinnerAction(Request $request)
	{
		$winner = $request->request->get('winner');
		
		$lastWinnerDni = isset($_SESSION['last_winner_dni'])?$_SESSION['last_winner_dni']:'-1';
		
		$dataProvider = $this->get('data_provider');
		$user = $dataProvider->findParticipantByDni($winner['dni']);
		$winProduct = $dataProvider->findProductById($_SESSION['last_win_product_id']);
		
		if($user && ($user->getDni() == $lastWinnerDni))
		{
			//Update winner
			$user->setFullname($winner['fullname']);
			$user->setPhone($winner['phone']);
			$user->setEmail($winner['email']);
			$this->get('database')->getEntityManager()->flush();
			
			//Send email
			$emailTo = $this->container->getParameter('violetta.contact.mail');
			$body = $this->templating->render('Main/Mailer/Email.php', array(
				'winner' => $winner,
				'product' => $winProduct
			));
			$this->get('violetta.send.mailer')->sendWinnerMail($winner, $emailTo, $body);
			
			//Get the view
			$view = $this->templating->render('Main/winnerUpdated.php');
		}
		else 
		{
			$view = $this->templating->render('Main/errorParticipating.php', array(
				'message' => "Se produjo un error al guardar los datos. Inténtalo nuevamente.",
			));
		}
		
		//Return the view, without layout (popup)
		return new Response($view);
	}
	
	public function basesAction(Request $request)
	{
		return new Response($this->templating->render('Main/bases.php'));
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}