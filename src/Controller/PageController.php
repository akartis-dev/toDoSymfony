<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

	/**
	 * @Route("/", name="page.index")
	 * @return Response
	 */
	public function index(): Response
	{
		return $this->render('page/index.html.twig', [
			'page' => 'index'
		]);
	}

	/**
	 * @Route("/about", name="page.about")
	 * @return Response
	 */
	public function about(): Response
	{
		return $this->render('page/about.html.twig', [
			'page' => 'about'
		]);
	}

	/**
	 * @Route("/contact", name="page.contact")
	 * @return Response
	 */
	public function contact(): Response
	{
		return $this->render('page/contact.html.twig', [
			'page' => 'contact'
		]);
	}

}
