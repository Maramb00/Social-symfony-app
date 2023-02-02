<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
  private array $messages = [
    ['message' => 'Hello', 'created' => '2022/06/12'],
    ['message' => 'Hi', 'created' => '2022/04/12'],
    ['message' => 'Bye!', 'created' => '2021/05/12']
  ];

  #[Route('/', name: 'app_index')]
  public function index(MicroPostRepository $posts, CommentRepository $comments): Response
  {

    
    return $this->render(
      'hello/index.html.twig',
      [
        'messages' => $this->messages,
        'limit' => 3
      ]
    );
  }
  #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
  public function showOne(int $id): Response
  {
    return $this->render(
      'hello/show_one.html.twig',
      [
        'message' => $this->messages[$id]
      ]
    );
  }
}