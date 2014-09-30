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

			if ($userParticipation != null)//it is able to participate
			{
				$winProduct = $iUtilHelper->executeConcourse($registeredUser);
				
				if ($winProduct != null)
				{
					// TODO: gano -> mostrar pantalla ganador
				}
				else
				{
					// TODO: no gano -> mostrar pantalla "gracias por participar"
				}
				
			}//it is not able to participate
			else{
				// TODO: mostrar mensaje de error diciendo que noe está habilitado para participar
			}
			
		
		}
		else{ //TODO: mostrare mensaje de error "codigo invalido".
		
		}
				
		return $this->render('Main/ganador.php', array(
			'code' => $code,
        	'dni' => $dni,
        )); 
	}

	public function updateWinnerAction(Request $request)
	{
			$dni = $request->request->get('dni');
			$code = $request->request->get('code');
			$fullname = $request->request->get('fullname');
			$phone = $request->request->get('phone');
			$email = $request->request->get('email');
		
		// TODO: VALIDAR dni igual al DNI con el que participó
		return $this->render('Main/winnerUpdated.php');
		//sino
			//TODO: mostrar pantalla de "dni no coincide"
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}

