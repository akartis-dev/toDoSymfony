<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\EventListener;


use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestJsonTransformListener
{

	public function onKernelRequest(RequestEvent $event)
	{
//		dd($event->getRequest()->getContent());
	}

}
