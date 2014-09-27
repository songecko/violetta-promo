<?php

namespace Odiseo\ViolettaPromo\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AppListener implements EventSubscriberInterface {
	private $container;
	private $request;
	
	public function __construct(ContainerBuilder $container) 
	{
		$this->container = $container;
	}
	
	public function onKernelRequest(GetResponseEvent $event) 
	{
	}
	
	
	protected function redirectToRoute(GetResponseEvent $event, $routeName) 
	{
		if (! $this->isOnRoute ( $routeName ))
			$event->setResponse ( $this->redirect ( $this->generateUrl ( $routeName ) ) );
	}
	
	protected function isOnRoute($routes)
	{
		//TODO: Refactorizacion (crear un Matcher)
		if(!is_array($routes))
			$routes = array($routes);
	
		$onRoute = false;
		foreach ($routes as $routeName)
		{
			$parameters = $this->container->get('matcher')->match($this->request->getPathInfo());
			$onRoute = ($parameters['_route'] == $routeName)?true:$onRoute;
		}
		 
		return $onRoute;
	}
	
	protected function redirect($url) 
	{
		return new RedirectResponse ( $url );
	}

	protected function generateUrl($routeName)
    {
    	return $this->container->get('routing.generator')->generate($routeName);
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 32)),
        );
    }
}
