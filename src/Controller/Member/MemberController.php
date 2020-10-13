<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\Member;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController
 * @package App\Controller\Member
 * @Route("/member")
 */
class MemberController extends AbstractController
{

	/**
	 * @Route("/", name="member.index")
	 * @return Response
	 */
	public function index(): Response
	{
		return $this->render('member/index.html.twig', [
			'page' => 'index'
		]);
	}

	/**
	 * @Route("/profile", name="member.profile")
	 * @return Response
	 */
	public function profile(): Response
	{
		return $this->render('member/profile.html.twig', [
			'page' => 'profile'
		]);
	}

}
