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
		if ($iUtilHelper->validateCode($code))
		{
			
			//FIXME: VALIDAR SI EL PARTICIPANTE YA PARITICIPO ESTE DÍA.
			
			$user = new User();
			$user->setDni($dni);
			$iUtilHelper->executeConcourse($user);
		
		
		}
		else{
		 //mostrare mensaje de error "codigo invalido".
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
	
		return $this->render('Main/winnerUpdated.php');
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}

