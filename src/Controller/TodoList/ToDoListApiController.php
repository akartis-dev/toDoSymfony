<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\TodoList;

use App\Entity\Todo\ToDoCategorie;
use App\Repository\Todo\ToDoCategorieRepository;
use App\Repository\Todo\ToDoListRepository;
use App\Service\DataSerializerHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

	public function __construct(ToDoListRepository $listRepository, ToDoCategorieRepository $toDoCategorieRepository, DataSerializerHelper $serializer)
	{
		$this->listRepository = $listRepository;
		$this->serializer = $serializer;
		$this->toDoCategorieRepository = $toDoCategorieRepository;
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
