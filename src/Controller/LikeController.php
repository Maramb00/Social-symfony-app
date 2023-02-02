<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LikeController extends AbstractController
{
    #[Route('/like/{id}', name: 'app_like')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function like(MicroPost $post,
    MicroPostRepository $posts,
    Request $request): Response
    {
    $currentUser= $this->getUser();
    $post->addLikedBy($currentUser);
    $posts->save($post,true);

        return $this->redirect($request->headers->get('referer'));
    }


    #[Route('/unlike/{id}', name: 'app_unlike')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function unlike(MicroPost $post,
    MicroPostRepository $posts,
    Request $request): Response
    {
    $currentUser= $this->getUser();
    $post->removeLikedBy($currentUser);
    $posts->save($post,true);

        return $this->redirect($request->headers->get('referer'));
    }
}
