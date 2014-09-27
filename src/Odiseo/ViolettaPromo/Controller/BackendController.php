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

class BackendController extends Controller
{		
	public static $validUsername = 'admin';
	public static $validPassword = '00859dc8ad5fe9c4232e7a63fc30a536f4f39729';
	
	protected function checkLogin()
	{
		$username = isset($_SESSION['username'])?$_SESSION['username']:null;
		$password = isset($_SESSION['password'])?$_SESSION['password']:null;
		
		if($username && $username == self::$validUsername
			&& $password && sha1($password) == self::$validPassword)
		{
			return true;
		}
		
		return false;
	} 
	
	public function loginAction(Request $request)
	{
		$error = false;
		
		if($request->isMethod('post'))
		{
			$login = $request->get('login');
			
			$_SESSION['username'] = $login['username'];
			$_SESSION['password'] = $login['password'];
			
			if($this->checkLogin())
			{
				return $this->redirect($this->generateUrl('backend_user_index'));
			}else {
				$error = 'Usuario y/o contraseña incorrectos';
			}
		}
		
		return $this->render('Backend/login.php', array(
			'error' => $error
		), 'admin_login_layout');
	}
	
	public function userIndexAction(Request $request)
	{
		if(!$this->checkLogin())
		{
			return $this->redirect($this->generateUrl('backend_login'));
		}
		
		$conn = $this->container->get('database')->getConnection();
		
		$users = $conn->fetchAll('SELECT * FROM user AS u ORDER BY u.id DESC');
		
		return $this->render('Backend/user/index.php', array(
			'users' => $users
		), 'admin_layout');
	}
	
	public function userVideoConvertAction(Request $request)
	{
		if(!$this->checkLogin())
		{
			return $this->redirect($this->generateUrl('backend_login'));
		}
		
		$conn = $this->container->get('database')->getConnection();
		$user = $conn->fetchAssoc('SELECT * FROM user WHERE id = ?', array($request->get('id')));
		
		$output = null;
		$response = '¡Se produjo un error! Vuelta a intentarlo mas tarde.';
		
		if(!$user)
		{
			die('no user');	
		}
		
		$fileBasename = pathinfo($user['video_file_name'], PATHINFO_FILENAME);
		$fileExtension = pathinfo($user['video_file_name'], PATHINFO_EXTENSION);
		
		$inputAudio = '';
		if(strpos($user['video_file_name'], 'webm'))
		{
			$inputAudio = ' -i uploads/'.$user['audio_file_name'];
		}
		
		$inputVideo = 'uploads/'.$user['video_file_name'];
		$outputVideo = 'uploads/'.$fileBasename;
		
		if((isset($_SESSION['last_rotate']) && $_SESSION['last_rotate'] == $user['id']))
		{
			$inputVideo = 'uploads/'.$fileBasename.'_rotated.'.$fileExtension;
			$outputVideo = 'uploads/'.$fileBasename.'_rotated';
		}
		
		if($request->get('rotate_hard'))
		{
			$_SESSION['last_rotate'] = $user['id'];
		}
		
		$inputVideo = 'uploads/'.$fileBasename.'.webm';
		
		$commandOgg = "/opt/ffmpeg/ffmpeg -i ".$inputVideo.$inputAudio." -b 1500k -y ".$outputVideo.".ogv 2>&1";
		$commandX264 = "/opt/ffmpeg/ffmpeg -i ".$inputVideo.$inputAudio." -b:v 1500k -vcodec libx264 -g 30 -s 640x360 -y ".$outputVideo.".mp4 2>&1";
		$commandWebm = "/opt/ffmpeg/ffmpeg -i ".$inputVideo.$inputAudio." -b 1500k -vcodec libvpx -acodec libvorbis -ab 160000 -f webm -g 30 -s 640x360 -y ".$outputVideo.".webm 2>&1";
		$commandImage = "/opt/ffmpeg/ffmpeg -i ".$inputVideo.$inputAudio." -ss 00:01 -vframes 1 -r 1 -s 640x360 -f image2 -y ".$outputVideo.".jpg 2>&1";
		$commandRotate = '/opt/ffmpeg/ffmpeg -i '.$inputVideo.' -vf vflip -c:a copy -y uploads/'.$fileBasename.'_rotated.'.$fileExtension.' && /opt/ffmpeg/ffmpeg -i uploads/'.$fileBasename.'_rotated.'.$fileExtension.' -c:a copy -y '.$inputVideo.'  2>&1';

		if($request->get('ogg') && !strpos($user['video_file_name'], 'ogv'))
		{
			$command = $commandOgg;
		}else if($request->get('x264') && !strpos($user['video_file_name'], 'mp4'))
		{
			$command = $commandX264;
		}else if($request->get('webm'))
		{
			$command = $commandWebm;
		}else if($request->get('image'))
		{
			$command = $commandImage;
			$_SESSION['last_rotate'] = 0;
		}else if($request->get('rotate') || $request->get('rotate_hard'))
		{
			$command = $commandRotate;
		}
		
		exec($command, $output);
		
		if(is_array($output)) $response = '';
		
		foreach ($output as $o)
		{
			$response .= $o.'<br>';
		}
		
		return new Response($response);
	}
	
	public function userDeleteAction(Request $request)
	{
		if(!$this->checkLogin())
		{
			return $this->redirect($this->generateUrl('backend_login'));
		}
		
		$conn = $this->container->get('database')->getConnection();
		$conn->delete('user', array('id' => $request->get('id')));
	
		return $this->redirect($this->generateUrl('backend_user_index'));
	}
	
	public function userToggleEnabledAction(Request $request)
	{
		if(!$this->checkLogin())
		{
			return $this->redirect($this->generateUrl('backend_login'));
		}
		
		$conn = $this->container->get('database')->getConnection();
		$user = $conn->fetchAssoc('SELECT * FROM user WHERE id = ?', array($request->get('id')));
		
		if($user['enabled'] == 1)
		{
			$conn->update('user', array('enabled' => 0), array('id' => $user['id']));
		}else 
		{
			$conn->update('user', array('enabled' => 1), array('id' => $user['id']));
		}
	
		return $this->redirect($this->generateUrl('backend_user_index'));
	}
	
	public function userDownloadExcelAction(Request $request)
	{
		if(!$this->checkLogin())
		{
			return $this->redirect($this->generateUrl('backend_login'));
		}
		
		$conn = $this->container->get('database')->getConnection();
		$users = $conn->fetchAll('SELECT * FROM user AS u ORDER BY u.id DESC');
		
	
		$view = $this->templating->render('Backend/user/downloadExcel.php', array(
				'users' => $users
		));
	
		$response = new Response($view);
		$response->headers->set('Content-Type', 'application/octet-stream');
		$response->headers->set('Content-Disposition', 'attachment; filename=registros.xls');
		$response->headers->set('Pragma', 'no-cache');
		$response->headers->set('Expires', '0');
	
		return $response;
	}
	
	protected function getViewsDir()
	{
		return __DIR__.'/../Resources/views/%name%';
	}
}