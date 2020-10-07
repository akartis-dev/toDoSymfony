<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\TodoList;

use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoList;
use App\Repository\Todo\ToDoCategorieRepository;
use App\Repository\Todo\ToDoListRepository;
use App\Service\DataSerializerHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member/api/todo")
 * Class ToDoListApiController
 * @package App\Controller\TodoList
 */
class ToDoListApiController extends AbstractController
{

	private ToDoListRepository $listRepository;
	private DataSerializerHelper $serializer;
	private ToDoCategorieRepository $toDoCategorieRepository;
	private EntityManagerInterface $em;

	public function __construct(ToDoListRepository $listRepository, ToDoCategorieRepository $toDoCategorieRepository, DataSerializerHelper $serializer, EntityManagerInterface $em)
	{
		$this->listRepository = $listRepository;
		$this->serializer = $serializer;
		$this->toDoCategorieRepository = $toDoCategorieRepository;
		$this->em = $em;
	}

	/**
	 * @Route("/", name="api.todo.coll.get", methods={"GET"})
	 * @return Response
	 */
	public function collectionCategorieGet(): Response
	{
		$res = $this->toDoCategorieRepository->findAll();
		return $this->serializer->serializeData($res, 'categorie');
	}

	/**
	 * @Route("/", name="api.todo.coll.post", methods={"POST"})
	 * @param Request $request
	 * @return Response
	 */
	public function collectionToDoListPost(Request $request): Response
	{
		$todo = $this->serializer->deserializeToDoList($request->getContent());
		$this->em->persist($todo);
		$this->em->flush();
		return $this->serializer->serializeData($todo, 'todo');
	}

	/**
	 * @Route("/{uuid}", name="api.todo.item.get", methods={"GET"})
	 * @param ToDoCategorie $categorie
	 * @return Response
	 */
	public function itemCategorieGet(?ToDoCategorie $categorie): Response
	{
		if ($categorie) {
			return $this->serializer->serializeData($categorie, 'todo');
		}
		throw new NotFoundHttpException('Categorie introuvable');
	}
}
