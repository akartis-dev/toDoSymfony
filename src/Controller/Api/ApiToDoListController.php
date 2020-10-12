<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\Api;


use App\Entity\Todo\ToDoList;
use App\Service\DataSerializerHelper;
use App\Traits\GroupsSerializerTrait;
use Doctrine\ORM\EntityManagerInterface;
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
	private EntityManagerInterface $em;

	public function __construct(DataSerializerHelper $serializer, EntityManagerInterface $em)
	{
		$this->serializer = $serializer;
		$this->em = $em;
	}

	/**
	 * @Route("/{uuid}", name="api.todo.item.put", methods={"PUT"})
	 * @param ToDoList|null $list
	 * @param Request $request
	 * @return Response
	 */
	public function itemCategoriePut(?ToDoList $list, Request $request): Response
	{
		if (!$list) {
			throw new NotFoundHttpException('Items introuvable');
		}
		sleep(5);
		return $this->json(['dasdasa']);
//		$res = $this->serializer->deserializePut($list, $request->getContent(), $this->TO_DO_LIST_PUT);
//		return $this->serializer->serializeData($res, $this->TO_DO_LIST_GET);
	}

	/**
	 * @Route("/{uuid}", name="api.todo.item.delete", methods={"DELETE"})
	 * @param ToDoList|null $list
	 * @return Response
	 */
	public function itemCategorieDelete(?ToDoList $list): Response
	{
		if (!$list) {
			throw new NotFoundHttpException('Items introuvable');
		}
		$this->em->remove($list);
		$this->em->flush();
		return (new Response())->setStatusCode(Response::HTTP_NO_CONTENT);
	}
}
