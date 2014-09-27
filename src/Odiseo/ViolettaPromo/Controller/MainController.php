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
use DtvFbapp\Utils\FileValidator;


class MainController extends Controller
{		
	public function indexAction(Request $request)
	{
		$conn = $this->container->get('database')->getConnection();
		$facebook = $this->container->get('facebook');
		$mobileDetect = $this->container->get('mobile_detect');
		
		//If not logged in on facebook
		if(!$facebook->getUser())
		{
			$loginUrl = $facebook->getConfiguredLoginUrl();
			//return new Response("<script>window.top.location.replace('".$loginUrl."');</script>");
		}
		
		//If the code is presented, means is a facebook redirect
		if(!$facebook->getSignedRequest() && !$request->get('noredirect') && !$mobileDetect->isMobile())
		{
			//return $this->redirect($facebook->getTabUrl());
		}
		
		$users = $conn->fetchAll('SELECT * FROM user AS u WHERE u.enabled = 1 ORDER BY u.id DESC');
		
		return $this->render('Main/index.php', array(
			'users' => $users
		));
	}
	
	public function likeAction(Request $request)
	{
		return $this->render('Main/like.php');
	}

	public function registerAction(Request $request)
	{
		/** REGISTER INTO DB **/
		$register = $request->get('register');
		$registerFiles = $request->files->get('register');
		
		if($register)
		{
			$facebook = $this->container->get('facebookUser');
			$error = false;
			
			$fbId = $facebook->getFcbkId();
			
			if(!$fbId)
			{
				$data = ['onError' => 'true', 'message' => 'No se pudo completar la operacion debido a que no has aceptado los permisos de Facebook.'];
				return $this->renderJsonResponse($data);
			}
			
			$name = $register['fullname'];
			$phone = $register['phone'];
			$email = $register['email'];
			$accountDtv = (isset($register['accountDtv']) && trim($register['accountDtv']) != '')?$register['accountDtv']:null;
			$hasDtv = (isset($register['hasdtv']) && $register['hasdtv']!='no')?1:0;		
				
			//Save the video (and audio)			
			$videoFilename = null;
			$audioFilename = null;
			$golVideo  = $registerFiles['golVideo'];
			$videoBlob = $register['golVideoBlob'];
			$audioBlob = $register['golAudioBlob'];
			
			$fileNameId = md5(time());

			if($golVideo && $golVideo instanceOf UploadedFile) //Si no se carga mediante input
			{
				$videoFilename =  $fileNameId.'.'.$golVideo->getClientOriginalExtension();				
				
				if ( !FileValidator::hasAvailableSize($golVideo) )
				{
					$data = ['onError' => 'true', 'message' =>  FileValidator::$MAX_FILE_ERROR];
					return $this->renderJsonResponse($data);
				}		
				if ( !FileValidator::hasAvailableMimeType($golVideo) ) {
					$data = ['onError' => 'true', 'message' => FileValidator::$INVALID_MIMETYPE];
					return $this->renderJsonResponse($data);
				}

				
				$videoFile = $golVideo->move('uploads', $videoFilename);
				
			}else if($videoBlob && $audioBlob) //Obtenemos el blob 
			{ 
				list($type, $videoData) = explode(';', $videoBlob);
				list(, $videoData)      = explode(',', $videoData);
				$videoFilename =  $fileNameId.'.webm';				
				
				list($type, $audioData) = explode(';', $audioBlob);
				list(, $audioData)      = explode(',', $audioData);
				$audioFilename =  $fileNameId.'.wav';
				
				$videoData64 = base64_decode($videoData);
				$audioData64 = base64_decode($audioData);
				
				$kbSize  = ( strlen( $videoData64)/1024 + strlen( $audioData64)/1024 );
				
				if ($kbSize > FileValidator::$MAX_FILE_SIZE){ // si es mayor a 10mb
					$data = ['onError' => 'true', 'message' =>  FileValidator::$MAX_FILE_ERROR];
					return $this->renderJsonResponse($data);
				}
				
				file_put_contents('uploads/'.$videoFilename, $videoData64);
				file_put_contents('uploads/'.$audioFilename, $audioData64);
			} else //No se pudo obtener el video  
			{
				$data = ['onError' => 'true', 'message' => FileValidator::$PROCESSING_FILE_ERROR];
				return $this->renderJsonResponse($data);
			}

			if(!$error)
			{
				//Guardado en base de datos
				$conn = $this->container->get('database')->getConnection();
				$userDbData = array(
					'fbid' => $fbId, 'full_name' => $name, 'phone' => $phone, 'email' => $email, 
					'dtv_account_number' => $accountDtv, 'has_dtv' => $hasDtv, 'video_file_name'=> $videoFilename
				);
			
				if($audioFilename)
				{
					$userDbData['audio_file_name'] = $audioFilename;
				}
				
				try {
					$result = $conn->insert('user', $userDbData);
					$userId = $conn->lastInsertId();
					if($result == true && $userId)
					{	
	
						$data = ['onError' => 'false', 'message' => 'proceso ok.', 'redirectUrl' => $this->generateUrl('thanks')];
						return $this->renderJsonResponse($data);
					}
				}catch (\Exception $e)
				{
					$data = ['onError' => 'true', 'message' => FileValidator::$USER_EXISTS];
					return $this->renderJsonResponse($data);
				}
			}
		}
		
		
		return $this->redirect($this->generateUrl('homepage'));
	}
		
	public function thanksAction(Request $request)
	{
		return $this->render('Main/thanks.php');
	}
	
	public function videosAction(Request $request)
	{
		$conn = $this->container->get('database')->getConnection();
		$users = $conn->fetchAll('SELECT * FROM user AS u WHERE u.enabled = 1 ORDER BY u.id DESC');
		
		return $this->render('Main/viewvideos.php', array(
				'users' => $users
		));
	}

	
	public function facebookLoginAction(Request $request)
	{
		$facebook = $this->container->get('facebook');
		if(!$facebook->getUser())
		{
			$loginUrl = $facebook->getConfiguredLoginUrl();
			return $this->redirect($loginUrl);
		}
		
		return $this->redirect($this->generateUrl('homepage'));
	}
	
	protected function render($name, array $parameters = array(), $layout = 'layout')
	{
		$md = $this->container->get('mobile_detect');
		if($md->isMobile())
		{
			$templateName = substr($name, 0, strpos($name, '.php'));
			$name = $templateName.'.m.php';			
		}
		
		return parent::render($name, $parameters, $layout);
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}