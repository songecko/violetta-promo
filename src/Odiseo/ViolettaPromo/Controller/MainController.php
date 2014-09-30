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


class MainController extends Controller
{		
	public function indexAction(Request $request)
	{		
		/////////////TEST/////////////
		$provider  = $this->get('data_provider');
		$isValid = $provider->findProductAvailabilityByProductId(1);
		
		$now = new \DateTime();
		d($isValid->getDate());
		d($now);
		$diff = $now->diff( $isValid->getDate());
		d($diff->days);
		return $this->render('Main/index.php');
		/////////////FIN TEST /////////////
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}