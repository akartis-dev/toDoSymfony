<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\Api;

use App\Entity\Todo\ToDoCategorie;
use App\Repository\Todo\ToDoCategorieRepository;
use App\Service\DataSerializerHelper;
use App\Traits\GroupsSerializerTrait;
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
class ApiToDoCategorieController extends AbstractController
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
	 * @Route("/", name="api.todo.coll.get", methods={"GET"})
	 * @return Response
	 */
	public function collectionCategorieGet(): Response
	{
		$res = $this->em->getRepository(ToDoCategorie::class)->findAll();
		return $this->serializer->serializeData($res, $this->TO_DO_CATEGORIE_GET);
	}

	/**
	 * @Route("/", name="api.todo.cat.post", methods={"POST"})
	 * @param Request $request
	 * @return Response
	 */
	public function collectionCategoriePost(Request $request): Response
	{
		$todo = $this->serializer->deserializeToDoCategorie($request->getContent());
		$this->em->persist($todo);
		$this->em->flush();
		return $this->serializer->serializeData($todo, $this->TO_DO_CATEGORIE_GET);
	}

	/**
	 * Get One categorie
	 * @Route("/{uuid}", name="api.todo.cat.get", methods={"GET"})
	 * @param ToDoCategorie $categorie
	 * @return Response
	 */
	public function itemCategorieGet(?ToDoCategorie $categorie): Response
	{
		if ($categorie) {
			return $this->serializer->serializeData($categorie, $this->TO_DO_LIST_GET);
		}
		throw new NotFoundHttpException('Categorie introuvable');
	}


}
