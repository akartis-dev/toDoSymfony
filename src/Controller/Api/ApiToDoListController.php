<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\Api;


use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoList;
use App\Service\DataSerializerHelper;
use App\Traits\GroupsSerializerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member/api/todo/list")
 * Class ApiToDoListController
 * @package App\Controller\Api
 */
class ApiToDoListController extends AbstractController
{
	use GroupsSerializerTrait;

	private DataSerializerHelper $serializer;

	public function __construct(DataSerializerHelper $serializer)
	{
		$this->serializer = $serializer;
	}

	/**
	 * @Route("/{uuid}", name="api.todo.item.get", methods={"PUT"})
	 * @param ToDoList|null $list
	 * @param Request $request
	 * @return Response
	 */
	public function itemCategoriePut(?ToDoList $list, Request $request): Response
	{
		if (!$list) {
			throw new NotFoundHttpException('Categorie introuvable');
		}
		$res = $this->serializer->deserializePut($list, $request->getContent(), $this->TO_DO_LIST_PUT);
		return $this->serializer->serializeData($res, $this->TO_DO_LIST_GET);
	}
}
