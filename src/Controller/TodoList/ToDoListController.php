<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\TodoList;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member/todo")
 * Class ToDoListController
 * @package App\Controller\TodoList
 */
class ToDoListController extends AbstractController
{

	/**
	 * @Route("/", name="todo.index")
	 * @return Response
	 */
	public function index(): Response
	{
		return $this->render('todo/index.html.twig', ['page' => 'todo']);
	}

}
