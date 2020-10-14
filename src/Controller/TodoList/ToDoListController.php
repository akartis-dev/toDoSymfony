<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\TodoList;


use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoEntities;
use Doctrine\ORM\EntityManagerInterface;
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

	private EntityManagerInterface $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	/**
	 * @Route("/", name="todo.index")
	 * @return Response
	 */
	public function index(): Response
	{
		$user = $this->getUser();
		$todoEntities = $this->em->getRepository(ToDoEntities::class)->findBy(['user' => $user], ['createdAt' => 'desc']);
		return $this->render('todo/index.html.twig', [
			'page' => 'todo',
			'data' => $todoEntities
		]);
	}

}
