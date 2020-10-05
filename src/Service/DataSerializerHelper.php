<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class DataSerializerHelper
{

	private SerializerInterface $serializer;

	public function __construct(SerializerInterface $serializer)
	{
		$this->serializer = $serializer;
	}

	/**
	 * Serialize data and return a response for api
	 * @param $res
	 * @param string $group
	 * @return Response
	 */
	public function serializeData($res, string $group): Response
	{
		$data = $this->serializer->serialize($res, 'json', ['groups' => $group]);
		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}

}
